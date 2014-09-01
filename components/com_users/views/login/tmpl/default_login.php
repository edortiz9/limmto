<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_SITE.'/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidation');

?>
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
    <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="login_form form-validate form-horizontal" id="login_form" name="login_form">    
    <!--HEADER-->
    <div class="header"></div>
    <div class="container-logo"></div>
    <!--END HEADER-->

    <!--CONTENT-->
    <div class="content">
        <input name="username" type="text" class="input username required validate-username" onfocus="this.value=''" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
        <input name="password" type="password" class="input password required validate-password" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
    </div>
    <!--END CONTENT-->
    <!--FOOTER-->
    <div class="footer">
            <div class="uk-grid">
            <div class="control-group uk-text-center">
                    <div class="controls">
                        <button name="login" type="submit" class="button" id="login_submit" tabindex="3"><?php echo JText::_('JLOGIN') ?></button>
                        <?php echo JHtml::_('form.token'); ?>
                    </div>
                    <?php
                    $usersConfig = JComponentHelper::getParams('com_users'); ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid='.UsersHelperRoute::getResetRoute()); ?>">
                            <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
            </div>
            </div>
        </div>
    <!--END FOOTER-->
    </div>
    </form>
</div>
</div>
