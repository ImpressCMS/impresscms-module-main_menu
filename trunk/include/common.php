<?php
/**
* Common file of the module included on all pages of the module
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

if(!defined("MAIN_MENU_DIRNAME"))		define("MAIN_MENU_DIRNAME", $modversion['dirname'] = basename(dirname(dirname(__FILE__))));
if(!defined("MAIN_MENU_URL"))			define("MAIN_MENU_URL", ICMS_URL.'/modules/'.MAIN_MENU_DIRNAME.'/');
if(!defined("MAIN_MENU_ROOT_PATH"))	define("MAIN_MENU_ROOT_PATH", ICMS_ROOT_PATH.'/modules/'.MAIN_MENU_DIRNAME.'/');
if(!defined("MAIN_MENU_IMAGES_URL"))	define("MAIN_MENU_IMAGES_URL", MAIN_MENU_URL.'images/');
if(!defined("MAIN_MENU_ADMIN_URL"))	define("MAIN_MENU_ADMIN_URL", MAIN_MENU_URL.'admin/');

// Include the common language file of the module
icms_loadLanguageFile('main_menu', 'common');

include_once(MAIN_MENU_ROOT_PATH . "include/functions.php");

// Creating the module object to make it available throughout the module
$main_menuModule = icms_getModuleInfo(MAIN_MENU_DIRNAME);
if (is_object($main_menuModule)){
	$main_menu_moduleName = $main_menuModule->getVar('name');
}

// Find if the user is admin of the module and make this info available throughout the module
$main_menu_isAdmin = icms_userIsAdmin(MAIN_MENU_DIRNAME);

// Creating the module config array to make it available throughout the module
$main_menuConfig = icms_getModuleConfig(MAIN_MENU_DIRNAME);

// creating the icmsPersistableRegistry to make it available throughout the module
global $icmsPersistableRegistry;
$icmsPersistableRegistry = IcmsPersistableRegistry::getInstance();

?>