<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$lang = JFactory::getLanguage();

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.tooltip');

// Add Stylesheets
$doc->addStyleSheet('templates/' .$this->template. '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Load specific language related CSS
$file = 'language/' . $lang->getTag() . '/' . $lang->getTag() . '.css';
if (is_file($file))
{
	$doc->addStyleSheet($file);
}

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<jdoc:include type="head" />
	<script type="text/javascript">
       	    jQuery(function($) {
            	$( "#form-login input[name='username']" ).focus();
            });
	</script>
	<style type="text/css">
		/* Responsive Styles */
		@media (max-width: 480px) {
			.view-login .container {
				margin-top: -170px;
			}
			.btn {
				font-size: 13px;
				padding: 4px 10px 4px;
			}
		}
		<?php // Check if debug is on ?>
		<?php if ($app->get('debug_lang', 1) || $app->get('debug', 1)) : ?>
			.view-login .container {
				position: static;
				margin-top: 20px;
				margin-left: auto;
				margin-right: auto;
			}
			.view-login .navbar-fixed-bottom {
				display: none;
			}
		<?php endif; ?>
                #notify {
                    margin: 40px auto !important;
                    width: 305px !important;
                }        
	</style>
	<!--[if lt IE 9]>
		<script src="../media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . $task . " itemid-" . $itemid . " ";?>">
	<!-- Container -->
        <jdoc:include type="message" />
	<div class="container">
		<div id="content">
			<!-- Begin Content -->
			<div id="element-box" class="login well">
				<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/logo-lime-index.png" alt="LIMMTO Software de Mantenimiento" />
				<hr />
				<jdoc:include type="component" />
			</div>
			<noscript>
				<?php echo JText::_('JGLOBAL_WARNJAVASCRIPT') ?>
			</noscript>
			<!-- End Content -->
		</div>
	</div>
	<div class="navbar navbar-fixed-bottom hidden-phone">
		<p class="pull-right">
			Copyright &copy; <?php echo date('Y');?> Limpieza Metroplolitana S.A. E.S.P LIME
		</p>
		<a href="<?php echo JUri::root(); ?>" target="_blank" class="pull-left"><i class="icon-share icon-white"></i> <?php echo JText::_('COM_LOGIN_RETURN_TO_SITE_HOME_PAGE') ?></a>
	</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
