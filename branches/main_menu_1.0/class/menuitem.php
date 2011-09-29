<?php

/**
* Classes responsible for managing Main_Menu menuitem objects
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

// including the IcmsPersistabelSeoObject
include_once ICMS_ROOT_PATH . '/kernel/icmspersistableobject.php';
include_once(ICMS_ROOT_PATH . '/modules/main_menu/include/functions.php');

class Main_menuMenuitem extends IcmsPersistableObject {

	/**
	 * Constructor
	 *
	 * @param object $handler Main_menuPostHandler object
	 */
	public function __construct(& $handler) {
		global $icmsConfig;

		$this->IcmsPersistableObject($handler);

		$this->quickInitVar('menuitem_id', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('parent_id', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('name', XOBJ_DTYPE_TXTBOX, true);
		$this->quickInitVar('title', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('url', XOBJ_DTYPE_TXTBOX, true);
		$this->quickInitVar('short_url', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('target', XOBJ_DTYPE_TXTBOX, true, null, null, '_self');
		$this->quickInitVar('image_normal', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('image_active', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('image_over', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('visible', XOBJ_DTYPE_INT, true, null, null, true);
		$this->quickInitVar('enabled', XOBJ_DTYPE_INT, true, null, null, true);

		$this->initCommonVar('weight');

		$this->setControl ( 'visible', 'yesno' );
		$this->setControl ( 'enabled', 'yesno' );
		$this->setControl ( 'image_normal', 'image' );
		$this->setControl ( 'image_active', 'image' );
		$this->setControl ( 'image_over', 'image' );
		$this->setControl ( 'parent_id', array(
										'object'=>$this,
										'method'=>'getFormatedOtherNodesList'
									) );
		$this->setControl ( 'target', array(
										'object'=>$this,
										'method'=>'getPossibleTargets'
									) );

	}

	/**
	 * Overriding the IcmsPersistableObject::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	function getVar($key, $format = 's') {
		if ($format == 's' && in_array($key, array ())) {
			return call_user_func(array ($this,	$key));
		}
		return parent :: getVar($key, $format);
	}


	/**
	 * Gets formated other nodes list to show parents nodes
	 */
	public function &getFormatedOtherNodesList() {
		require_once ICMS_ROOT_PATH . '/class/criteria.php';
		require_once ICMS_ROOT_PATH . '/class/tree.php';
		//$items = &$this->handler->getObjects(new Criteria('menuitem_id', $this->id(), '=', 'NOT'), false, false);
		$tree = new XoopsObjectTree($this->handler, 'parent_id', 'menuitem_id');
		$tmp = $tree->makeSelBox('test', 'name', '-', '', false, 0);
		preg_match_all("|<option.+value=\"([^\"]+)\">(.*)</option>|U", $tmp, $out, PREG_SET_ORDER);
		$result = array(0 => '------');
		foreach($out as $item) {
			$result[intval($item[1])] = $item[2];
		}
		return $result;
	}

	/**
	 * Get's possible targets
	 */
	public function getPossibleTargets() {
		return array('_blank' => _CO_MAIN_MENU_MENUITEM_TARGET_BLANK, 
					 '_parent' => _CO_MAIN_MENU_MENUITEM_TARGET_PARENT,
					 '_self' => _CO_MAIN_MENU_MENUITEM_TARGET_SELF,
					 '_top' => _CO_MAIN_MENU_MENUITEM_TARGET_TOP);
	}

	
	public function setVar($var, $value) {
		if ($var == 'url') {
			require_once dirname(__FILE__) . '/htaccess.php';
			$htaccess = &htaccessFile::getInstance();
			$ln = $htaccess->findFirstLineByTypeAndPropertyValue('RewriteRule', 'url', $this->makeRelativeURLifPossible().'$1', false);
			if (is_numeric($ln)) {
				$htaccess->delete($ln);
			}
		}
		return parent::setVar($var, $value);
	}

	public function makeRelativeURLifPossible() {
		$url = $this->getVar('url');
		if (substr($url, 0, strlen(ICMS_URL)) == ICMS_URL){
			$url = trim(substr($url, strlen(ICMS_URL)));
			if (substr($url, 0, 1) != '/') {
				$url = '/' . $url;
			}
			if (substr($url, strlen($url) - 1) == '/') {
				$url .= 'index.php';
			}
		}
		return $url;
	}

	public function toArray() {
		$rez = parent::toArray();
		if (strlen(trim($rez['short_url']))>0) {
			$rez['true_url'] = ICMS_URL . '/' . $rez['short_url'];
		} else {
			$rez['true_url'] = $rez['url'];
		}
		if (substr($rez['url'], 0, strlen(ICMS_URL)) == ICMS_URL){
			$url = 'http' . ((isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on"))?'s':'') . '://' . $_SERVER["SERVER_NAME"] . (($_SERVER["SERVER_PORT"] != '80')?$_SERVER["SERVER_PORT"]:'') . $_SERVER["REQUEST_URI"];
			if (substr(strtolower($url), 0, strlen($rez['url'])) == strtolower($rez['url'])){
				$rez['selected'] = true;
			} elseif (substr(strtolower($url), 0, strlen($rez['true_url'])) == strtolower($rez['true_url'])) {
				$rez['selected'] = true;
			} else {
				$rez['selected'] = false;
			}
		} else {
			$rez['selected'] = false;
		}
//		if (
//		$rez['selected'] = 
		return $rez;
	}


}
class Main_menuMenuitemHandler extends IcmsPersistableObjectHandler {

	/**
	 * Constructor
	 */
	public function __construct(& $db) {
		$this->IcmsPersistableObjectHandler($db, 'menuitem', 'menuitem_id', 'name', 'title', 'main_menu');
		$this->enableUpload(false, 3000000, 16000, 12000);
	}	

	public function afterSave(&$obj) {
		require_once dirname(__FILE__) . '/htaccess.php';
		$htaccess = &htaccessFile::getInstance();
		$htaccess->toggleFeature('RewriteEngine', 'on');
		$ln = $htaccess->findFirstLineByTypeAndPropertyValue('Options', 'FollowSymlinks', true, false);
		if ($ln === false) {
			$options = &$htaccess->add('Options');
			$options->toggleOption('FollowSymlinks', true);
		}
		$url = $obj->makeRelativeURLifPossible();
		$rule = '^' . $obj->getVar('short_url') . '(.*)$';
		$htaccess->add('RewriteRule', $rule, $url.'$1');	
		$htaccess->write();
		return true;
	}

	public function beforeDelete(&$obj) {
		require_once dirname(__FILE__) . '/htaccess.php';
		$htaccess = &htaccessFile::getInstance();		
		$ln = $htaccess->findFirstLineByTypeAndPropertyValue('RewriteRule', 'url', $obj->makeRelativeURLifPossible(), false);
		if (is_numeric($ln)) {
			$htaccess->delete($ln);
			$htaccess->write();
		}
		return true;
	}

	public function &getItemsForDisplay() {
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('visible', 1));
		$criteria->setSort('weight');
		$criteria->setOrder('ASC');
		$objs = &$this->getObjects($criteria, false, false);
		return $objs;
	}

}
?>