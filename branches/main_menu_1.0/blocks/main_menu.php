<?php

/**
* $Id: random_offer.php 329 2007-12-23 15:43:30Z malanciault $
* Module: SmartPartner
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

function main_menu_show($options)
{
	$main_menu_menuitem_handler = icms_getModuleHandler('menuitem', 'main_menu');
	$result = array();
	$result['items'] =	&$main_menu_menuitem_handler->getItemsForDisplay();
	return $result;
}

function main_menu_edit($options)
{
	return '-';
}
?>