<?php
/**
* Footer page included at the end of each page on user side of the mdoule
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

$icmsTpl->assign("main_menu_adminpage", main_menu_getModuleAdminLink());
$icmsTpl->assign("main_menu_is_admin", $main_menu_isAdmin);
$icmsTpl->assign('main_menu_url', MAIN_MENU_URL);
$icmsTpl->assign('main_menu_images_url', MAIN_MENU_IMAGES_URL);

$xoTheme->addStylesheet(MAIN_MENU_URL . 'module'.(( defined("_ADM_USE_RTL") && _ADM_USE_RTL )?'_rtl':'').'.css');

include_once(ICMS_ROOT_PATH . '/footer.php');

?>