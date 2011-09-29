<?php
/**
* Common functions used by the module
*
* @copyright	
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		MekDrop <i.know@mekdrop.name>
* @package		main_menu
* @version		$Id$
*/
/**
 * Notification lookup function
 *
 * This function is called by the notification process to get an array contaning information
 * about the item for which there is a notification
 *
 * @param string $category category of the notification
 * @param int $item_id id f the item related to this notification
 *
 * @return array containing 'name' and 'url' of the related item
 */
function main_menu_notify_iteminfo($category, $item_id){
    global $icmsModule, $icmsModuleConfig, $icmsConfig;

    if ($category == 'global') {
        $item['name'] = '';
        $item['url'] = '';
        return $item;
    }

}

?>