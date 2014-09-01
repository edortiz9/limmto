<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.tooltip');

?>
<link href="modules/mod_starazure_loginfree/asset/css/style.css" rel="stylesheet">
<div class="reset-confirm<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
<div id="content-container">   
 <div id="login-container">
    <div class="wrapper">
    <!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->    
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.confirm'); ?>" method="post" id="login_form" name="login_form" class="login_form form-validate">
        <!--HEADER-->
        <div class="header"></div>
        <div class="container-logo"></div>
        <!--END HEADER-->
        <!--CONTENT-->
        <div class="content">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
		<p><?php echo JText::_($fieldset->label); ?></p>		
			<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
				<?php echo $field->label; ?>
				<?php echo $field->input; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
        </div>
        <div class="footer">
		<div class="uk-grid">
                    <div class="control-group uk-text-center">
                    <div class="controls">
			<button type="submit" class="button validate"><?php echo JText::_('JSUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
                    </div>
                    </div>
                </div>    
        </div>            
	</form>
    </div>
 </div>
</div>    
</div>
