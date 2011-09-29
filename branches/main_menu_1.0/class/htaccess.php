<?php

define('MM_HTACCESS_LOCATION', dirname(__FILE__) .'/htaccess/');
define('MM_HTACCESS_COMMANDS_LOCATION', dirname(__FILE__) .'/htaccess/commands/');

class htaccessFile {

	private $readOnly = array('content' => array());
	private $false = false;
	private static $instances = array();

	public static function &getInstance($path = ICMS_ROOT_PATH) {
		if (!isset(htaccessFile::$instances[$path])) {
			htaccessFile::$instances[$path] = new htaccessFile($path);
		}
		return htaccessFile::$instances[$path];
	}

	public function __construct($path = ICMS_ROOT_PATH) {		
		if (!is_dir($path)) {
			$path = dirname($path); 
		} else {
			$this->readOnly['path'] = $path;
		}
		$this->readOnly['file'] = $this->readOnly['path'] . '/.htaccess';
		$this->readOnly['canWrite'] = is_writable($this->readOnly['file']);
		$this->readOnly['canRead'] = is_readable($this->readOnly['file']);
		if ($this->readOnly['canRead']) {
			$this->read();
		}
	}

	public function getVar($var) {
		return $this->readOnly[$var];
    }

	public function read() {
		if (!$this->getVar('canRead')) {
			return false;
		}
		$data = file($this->getVar('file'), FILE_IGNORE_NEW_LINES | FILE_TEXT);
		$this->readOnly['content'] = array();
		foreach ($data as $line) {
			$line = trim($line);
			if (strlen($line) == 0) { //this is blank line
				$this->add('empty');
			} elseif (substr($line, 0, 1) == '#') { //this is comment
				$this->add('comment', substr($line, 1));
			} else {
				$data = explode(' ', $line);
				$type = $data[0];
				unset($data[0]);
				$code = '$this->add(\''.$type.'\', \''.((count($data)>0)?implode('\',\'', $data):'').'\');';
				eval ($code);
			}
		}
		return true;
	}

	public function write() {
		if (!$this->getVar('canWrite')) {
			return false;
		}
		file_put_contents($this->getVar('file'), $this->render());
		return true;
	}

	public function render() {
		return implode("\n", $this->toArray());
	}

	public function toArray() {
		$data = array();
		foreach ($this->readOnly['content'] as $line) {
			$data[] = trim($line->render());
		}
		return $data;
	}

	public function &findFirstLineByType($type, $returnAsObject = true) {
		foreach ($this->readOnly['content'] as $nr => $line) {
			if (strtolower($line->getType()) == strtolower($type)) {
				if ($returnAsObject) {
					return $line;
				} else {
					return $nr;
				}
			}
		}
		return $this->false;
	}

	public function hasLineType($type) {
		return (bool)$this->findFirstLineByType($type, false);
	}

	public function &findFirstLineByTypeAndPropertyValue($type, $property, $value, $returnAsObject = true) {
		foreach ($this->readOnly['content'] as $nr => $line) {
			if ((strtolower($line->getType()) == strtolower($type)) && $line->hasProperty($property, $value)) {
				if ($returnAsObject) {
					return $line;
				} else {
					return $nr;
				}
			}
		}
		return $this->false;
	}

	public function hasLineTypeAndPropertyValue($type, $property, $value) {
		return (bool)$this->findFirstLineByTypeAndPropertyValue($type, $property, $value, false);
	}

	public function &add($type) {
		$args = func_get_args();
		unset($args[0]);
		$args = array_values($args);
		switch ($type) {
			case 'comment':
				require_once  MM_HTACCESS_LOCATION . 'comment.php';
				$this->readOnly['content'][] = new htaccessLineComment($args[0]);
			break;
			case 'empty':
			case 'line':
				require_once  MM_HTACCESS_LOCATION . 'empty.php';
				$this->readOnly['content'][] = new htaccessLineEmpty();
			break;
			default:
				require_once  MM_HTACCESS_COMMANDS_LOCATION . strtolower($type) . '.php';
				$code = '$this->readOnly[\'content\'][] = new htaccessLineCommand'.$type.'(\''.((count($args)>0)?implode('\',\'', $args):'').'\');';
				eval($code);		
			break;
		}
		return $this->readOnly['content'][count($this->readOnly['content'])-1];
	}

	public function delete($nr) {
		unset($this->readOnly['content'][$nr]);
		$this->readOnly['content'] = array_values($this->readOnly['content']);
	}

	public function toggleFeature($feature, $state) {
		$ln = &$this->findFirstLineByType($feature, true);
		if (is_object($ln)) {
			$ln->setVar('on', $state);
		} else {
			$this->add('empty');
			$this->add($feature, $state);	
		}
	}

}

class htaccessLine {	

	protected $params = array(), $type = '';

	protected function __construct(&$obj) {
		$name = get_class($obj);
		if (strlen($name) > strlen('htaccessLineCommand')) {
			$this->type = substr($name, strlen('htaccessLineCommand'));
		} else {
			$this->type = '#' . substr($name, strlen('htaccessLine'));
		}
	}

	public function getType() {
		return $this->type;
	}

	public function hasProperty($var, $value) {
		if (!isset($this->params[$var]['value'])) return false;
		return ($this->params[$var]['value']==$value);
	}

	public function initVar($var, $type, $defaultValue = null) {
		$this->params[$var] = array('type' => $type,
									'defaultValue' => $defaultValue,
									'value' => $defaultValue);
	}

	public function isChanged($var=null) {
		if ($var!==null) {
			return isset($this->params[$var]['value'])?($this->params[$var]['value']!=$this->params[$var]['defaultValue']):null;
		}
		$changed = false;
		foreach ($this->params as $var => $vl) {
			$changed = $changed || ($vl['value'] == $vl['defaultValue']);
		}
		return $changed;
	}

	public function setVar($var, $value) {
		if (isset($this->params[$var])) {
			$this->params[$var]['value'] = $value;
			return true;
		}
		return false;
	}

	public function getVar($var) {
		return isset($this->params[$var]['value'])?$this->params[$var]['value']:null;
	}

	public function toArray() {
		$result = array();
		foreach ($this->params as $var => $vl) {
			$result[$var] = $this->getVar($var);
		}
		return $result;
	}
	
	public function render() {
		$result = '';
		foreach($this->toArray() as $k => $v) {
			if (is_array($v)) {
				$result .= trim(implode(' ',$v));
			} else {
				$result .= $v;
			}
			$result .= ' ';
		}
		return trim($this->type . ' ' . ($result));
	}

}

?>