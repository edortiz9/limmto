<?php
/**
* @version		mod_bj_dropdown_menu.php 2010-07-22 11:20 PM
* @package		BJ! Venus
* @copyright	ByJoomla.com
* @author		hadoanngoc@byjoomla.com
**/
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
//require_once (dirname(__FILE__).DS.'helper.php');

// define parameters
$style = $params->get("themes","default");

require(JModuleHelper::getLayoutPath('mod_bj_dropdown_menu', $style));