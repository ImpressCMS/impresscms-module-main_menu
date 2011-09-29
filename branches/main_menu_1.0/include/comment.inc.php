<?php
/**
* Comment include file
*
* File holding functions used by the module to hook with the comment system of ImpressCMS
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/

function main_menu_com_update($item_id, $total_num)
{
    $main_menu_post_handler = icms_getModuleHandler('post', 'main_menu');
    $main_menu_post_handler->updateComments($item_id, $total_num);
}

function main_menu_com_approve(&$comment)
{
    // notification mail here
}

?>