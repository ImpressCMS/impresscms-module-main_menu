<?php

class htaccessLineCommandRewriteRule
	extends htaccessLine {

	function __construct($pregRule, $url, $mode = 'NC') {
		$this->initVar('rule', XOBJ_DTYPE_TXTBOX, $pregRule);
		$this->initVar('url', XOBJ_DTYPE_TXTBOX, $url);
		if (substr($mode,0,1) == '[') {
			$mode = substr($mode,1);
		}		
		if (substr($mode,strlen($mode)-1,1) == ']') {
			$mode = substr($mode,0, strlen($mode)-1);
		}
		$mode = explode(',',$mode);
		foreach ($mode as $k => $v) {
			$mode[$k] = trim($v);
		}
		$this->initVar('mode', XOBJ_DTYPE_ARRAY, $mode);
		parent::__construct($this);
	}

	public function render() {
		return 'RewriteRule '.$this->getVar('rule').' '.$this->getVar('url').' ['.implode(',',$this->getVar('mode')).']';
	}

}

?>