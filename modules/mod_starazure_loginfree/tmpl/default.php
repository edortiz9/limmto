<link href="modules/mod_starazure_loginfree/asset/css/main.css" rel="stylesheet">
<?php
/**
 * @package   StarAzure Login
 * @version   1.0
 * @author    StarAzure http://www.StarAzure.com
 * @copyright Copyright (C) 2013 - 2014 StarAzure
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidation');

?>

<?php if ($params->def('font', 1)): ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<?php endif; ?>

<link href="modules/mod_starazure_loginfree/asset/css/style.css" rel="stylesheet">
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(".username").focus(function() {
		jQuery(".user-icon").css("left","-48px");
	});
	jQuery(".username").blur(function() {
		jQuery(".user-icon").css("left","0px");
	});
	
	jQuery(".password").focus(function() {
		jQuery(".pass-icon").css("left","-48px");
	});
	jQuery(".password").blur(function() {
		jQuery(".pass-icon").css("left","0px");
	});
});
</script>
<div id="content-container">   
 <div id="login-container">
<div class="wrapper">
    <!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login_form" name="login_form" class="login_form form-validate" >
	<?php if ($params->get('pretext')) : ?>
		<div>
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>    
    <!--HEADER-->
    <div class="header">
    <!--TITLE--><h1><?php echo ($params->get('heading')) ?></h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Software de Mantenimiento</span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->

    <!--CONTENT-->
    <div class="content">
        <input name="username" type="text" class="input username required validate-username" onfocus="this.value=''" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
        <input name="password" type="password" class="input password required validate-password" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
    </div>
    <!--END CONTENT-->
    <!--FOOTER-->
    <div class="footer">
        <?php if (count($twofactormethods) > 1): ?>
        <div id="form-login-secretkey" class="control-group">
            <div class="controls">
                <?php if (!$params->get('usetext')) : ?>
                <div class="input-prepend input-append">
                        <span class="add-on">
                                <span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
                                </span>
                                        <label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
                                </label>
                        </span>
                        <input id="modlgn-secretkey" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
                        <span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
                                <span class="icon-help"></span>
                        </span>
                </div>
                <?php else: ?>
                        <label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
                        <input id="modlgn-secretkey" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
                        <span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
                                <span class="icon-help"></span>
                        </span>
                <?php endif; ?>
            </div>
        </div>
		<?php endif; ?>
            <div class="uk-grid">
            <div class="control-group uk-text-center">
                    <div class="controls">
                        <button name="login" type="submit" class="button" id="login_submit" tabindex="3"><?php echo JText::_('JLOGIN') ?></button>
                    </div>
                    <?php
                    $usersConfig = JComponentHelper::getParams('com_users'); ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid='.UsersHelperRoute::getResetRoute()); ?>">
                            <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
            </div>
            </div>
        </div>
    <!--END FOOTER-->
		
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
	</form>
</div>
</div>
