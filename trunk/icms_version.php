<?php
/**
* Main_Menu version infomation
*
* This file holds the configuration information of this module
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
  'name'=> _MI_MAIN_MENU_MD_NAME,
  'version'=> 1.0,
  'description'=> _MI_MAIN_MENU_MD_DESC,
  'author'=> "MekDrop",
  'credits'=> "",
  'help'=> "",
  'license'=> "GNU General Public License (GPL)",
  'official'=> 0,
  'dirname'=> basename( dirname( __FILE__ ) ),

/**  Images information  */
  'iconsmall'=> "images/icon_small.png",
  'iconbig'=> "images/icon_big.png",
  'image'=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
  'status_version'=> "1.0",
  'status'=> "Beta",
  'date'=> "Unreleased",
  'author_word'=> "",

/** Contributors */
  'developer_website_url' => "http://mekdrop.name",
  'developer_website_name' => "MekDrop.Name",
  'developer_email' => "i.know@mekdrop.name");

$modversion['people']['developers'][] = "MekDrop";

$modversion['warning'] = _CO_ICMS_WARNING_BETA;

/** Administrative information */
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

/** Database information */
$modversion['object_items'][1] = 'menuitem';

$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Install and update informations */
$modversion['onInstall'] = "include/onupdate.inc.php";
$modversion['onUpdate'] = "include/onupdate.inc.php";

/** Search information */
$modversion['hasSearch'] = 0;

/** Menu information */
$modversion['hasMain'] = 0;

/** Blocks information */
$modversion['blocks'][1] = array(
  'file' => 'main_menu.php',
  'name' => _MI_MAIN_MENU_BLOCK,
  'description' => _MI_MAIN_MENU_BLOCKDSC,
  'show_func' => 'main_menu_show',
  'edit_func' => 'main_menu_edit',
  'options' => '5',
  'template' => 'main_menu.html');

$modversion['templates'][]= array(
  'file' => 'main_menu_admin_menuitem.html',
  'description' => 'menuitem Admin Index');


?>