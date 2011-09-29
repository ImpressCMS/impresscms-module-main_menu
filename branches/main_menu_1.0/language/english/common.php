<?php
/**
* English language constants commonly used in the module
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

// menuitem
define("_CO_MAIN_MENU_MENUITEM_NAME", "Field Name");
define("_CO_MAIN_MENU_MENUITEM_NAME_DSC", " If you select image for this menu item, this will be used as alt param, otherwise - as link text.");
define("_CO_MAIN_MENU_MENUITEM_TITLE", "Title");
define("_CO_MAIN_MENU_MENUITEM_TITLE_DSC", " This will be used for popuptext over your menu item.");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_NORMAL", "Image (normal)");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_NORMAL_DSC", " Default image for menu item.");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_ACTIVE", "Image (active)");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_ACTIVE_DSC", " Image show when menu item is active (only used if normal image is set).");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_OVER", "Image (over)");
define("_CO_MAIN_MENU_MENUITEM_IMAGE_OVER_DSC", " Image show when mouse pointer is over this menu item and normal image field is set.");
define("_CO_MAIN_MENU_MENUITEM_URL", "URL");
define("_CO_MAIN_MENU_MENUITEM_URL_DSC", " Link of page where this menu item is linked.");
define("_CO_MAIN_MENU_MENUITEM_SHORT_URL", "Short URL");
define("_CO_MAIN_MENU_MENUITEM_SHORT_URL_DSC", " If you run Apache and .htaccess in main CMS folder is writetable, you can use shorter url (for example: if your link is <i>http://impresscms.org/modules/imblogging/</i> you can write in this field blog to open your page with <i>http://impresscms.org/blog</i> link).");
define("_CO_MAIN_MENU_MENUITEM_VISIBLE", "Visible");
define("_CO_MAIN_MENU_MENUITEM_VISIBLE_DSC", " Select <i>Yes</i> if you want this menu item to be visible to user.");
define("_CO_MAIN_MENU_MENUITEM_PARENT_ID", "Parent");
define("_CO_MAIN_MENU_MENUITEM_PARENT_ID_DSC", " Select parent for this menu item.");
define("_CO_MAIN_MENU_MENUITEM_ENABLED", "Enabled");
define("_CO_MAIN_MENU_MENUITEM_ENABLED_DSC", " Select <i>Yes</i> if you want this menu item to be enabled to user.");
define("_CO_MAIN_MENU_MENUITEM_TARGET", "Target");
define("_CO_MAIN_MENU_MENUITEM_TARGET_DSC", "Where menu item must be opened?");

define("_CO_MAIN_MENU_MENUITEM_TARGET_BLANK", "Open in new window/tab");
define("_CO_MAIN_MENU_MENUITEM_TARGET_PARENT", "Open in parent window/tab");
define("_CO_MAIN_MENU_MENUITEM_TARGET_SELF", "Open in self window/tab");
define("_CO_MAIN_MENU_MENUITEM_TARGET_TOP", "Open in top window/tab");

define('_MI_MAIN_MENU_BLOCK','Main Menu');
define('_MI_MAIN_MENU_BLOCKDSC','This block will act as main menu.');
?>