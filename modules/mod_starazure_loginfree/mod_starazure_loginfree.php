<?php
/**
 * @package   StarAzure Login
 * @version   1.0
 * @author    StarAzure http://www.StarAzure.com
 * @copyright Copyright (C) 2013 - 2014 StarAzure
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

// Include the login functions only once
require_once __DIR__ . '/helper.php';

$params->def('greeting', 1);

$type	          = ModLoginStar::getType();
$return	          = ModLoginStar::getReturnURL($params, $type);
$twofactormethods = ModLoginStar::getTwoFactorMethods();
$user	          = JFactory::getUser();
$layout           = $params->get('layout', 'starazure');

// Logged users must load the logout sublayout
if (!$user->guest)
{
	$layout .= '_logout';
}

require JModuleHelper::getLayoutPath('mod_starazure_loginfree', $layout);
