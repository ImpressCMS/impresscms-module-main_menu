<?php
/**
* Admin page to manage menuitems
*
* List, add, edit and delete menuitem objects
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

/**
 * Edit a Menuitem
 *
 * @param int $menuitem_id Menuitemid to be edited
*/
function editmenuitem($menuitem_id = 0)
{
	global $main_menu_menuitem_handler, $icmsModule, $icmsAdminTpl;

	$menuitemObj = $main_menu_menuitem_handler->get($menuitem_id);

	if (!$menuitemObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_MAIN_MENU_MENUITEMS . " > " . _CO_ICMS_EDITING);
		$sform = $menuitemObj->getForm(_AM_MAIN_MENU_MENUITEM_EDIT, 'addmenuitem');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(0, _AM_MAIN_MENU_MENUITEMS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $menuitemObj->getForm(_AM_MAIN_MENU_MENUITEM_CREATE, 'addmenuitem');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:main_menu_admin_menuitem.html');
}

include_once("admin_header.php");

$main_menu_menuitem_handler = icms_getModuleHandler('menuitem');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod','changedField','addmenuitem','del','view','');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_menuitem_id = isset($_GET['menuitem_id']) ? (int) $_GET['menuitem_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op,$valid_op,true)){
  switch ($clean_op) {
  	case "mod":
  	case "changedField":

  		icms_cp_header();

  		editmenuitem($clean_menuitem_id);
  		break;
  	case "addmenuitem":
          include_once ICMS_ROOT_PATH."/kernel/icmspersistablecontroller.php";
          $controller = new IcmsPersistableController($main_menu_menuitem_handler);
  		$controller->storeFromDefaultForm(_AM_MAIN_MENU_MENUITEM_CREATED, _AM_MAIN_MENU_MENUITEM_MODIFIED);

  		break;

  	case "del":
  	    include_once ICMS_ROOT_PATH."/kernel/icmspersistablecontroller.php";
          $controller = new IcmsPersistableController($main_menu_menuitem_handler);
  		$controller->handleObjectDeletion();

  		break;

  	case "view" :
  		$menuitemObj = $main_menu_menuitem_handler->get($clean_menuitem_id);

  		icms_cp_header();
  		smart_adminMenu(1, _AM_MAIN_MENU_MENUITEM_VIEW . ' > ' . $menuitemObj->getVar('menuitem_name'));

  		smart_collapsableBar('menuitemview', $menuitemObj->getVar('menuitem_name') . $menuitemObj->getEditMenuitemLink(), _AM_MAIN_MENU_MENUITEM_VIEW_DSC);

  		$menuitemObj->displaySingleObject();

  		smart_close_collapsable('menuitemview');

  		break;

  	default:

  		icms_cp_header();

  		$icmsModule->displayAdminMenu(0, _AM_MAIN_MENU_MENUITEMS);

  		include_once ICMS_ROOT_PATH."/kernel/icmspersistabletable.php";
  		$objectTable = new IcmsPersistableTable($main_menu_menuitem_handler);
  		$objectTable->addColumn(new IcmsPersistableColumn('name'));
		$objectTable->addColumn(new IcmsPersistableColumn('weight'));
		$objectTable->addColumn(new IcmsPersistableColumn('enabled'));
		$objectTable->addColumn(new IcmsPersistableColumn('visible'));

  		$objectTable->addIntroButton('addmenuitem', 'menuitem.php?op=mod', _AM_MAIN_MENU_MENUITEM_CREATE);
  		$icmsAdminTpl->assign('main_menu_menuitem_table', $objectTable->fetch());
  		$icmsAdminTpl->display('db:main_menu_admin_menuitem.html');
  		break;
  }
  icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
?>