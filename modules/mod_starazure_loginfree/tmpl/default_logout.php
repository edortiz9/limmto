<link href="modules/ mod_starazure_loginfree/asset/css/Blue-Streak.css" rel="stylesheet">
<?php
/**
 * @package   StarAzure Login
 * @version   1.0
 * @author    StarAzure http://www.StarAzure.com
 * @copyright Copyright (C) 2013 - 2014 StarAzure
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<div class="logout_box_star">
<br/>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if ($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
	} endif; ?>
	</div>
<?php endif; ?>
<br/>
	<div class="logout-button">
		<input type="submit" name="Submit" class="uk-button uk-button-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
</div>
