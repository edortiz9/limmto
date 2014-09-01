<?php
defined('_JEXEC') or die;
// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$user = JFactory::getUser();
// almaceno el id en la variable llamada $tuid
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
if (!$user->id) : {
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();


// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$this->template='beez3';
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

$span = "span12";



?>
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
      
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">
	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
                        <jdoc:include type="message" />
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<main id="content" role="main" class="<?php echo $span;?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
                                <!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->        
				</main>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">

			<jdoc:include type="modules" name="footer" style="none" />
			<p class="copyright">
				Copyright &copy; <?php echo date('Y');?> Limpieza Metroplolitana S.A. E.S.P LIME
			</p>
		</div>
	</footer>
        <div class="locale-container" id="locale-container"></div>
        <div id="locale-footer" ></div>
	<jdoc:include type="modules" name="debug" style="none" />
        <?php
}else:{
JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss', false, $this->direction);    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>

<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/bootstrap/css/bootstrap-responsive.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/bootstrap/css/bootstrap-fileupload.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/font-awesome/css/font-awesome.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style-responsive.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style-default.css" type="text/css" id="style_color"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" type="text/css" media="screen" />
<jdoc:include type="head" />
<?php
JHtml::_('bootstrap.tooltip');
?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                   <div class="icon-reorder"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <div class="container-logo"></div>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <!-- BEGIN SUPPORT -->
                       <li class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Ayuda">
                               <i class="icon-headphones"></i>
                           </a>
                       </li>
                       <!-- END SUPPORT -->
                       <!-- BEGIN USER LOGIN DROPDOWN -->

                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <?php
                               require_once JPATH_SITE . '/plugins/content/imgresizecache/resize.php';
                               $resizer = new ImgResizeCache();
                               if ($user->get('imagen')) {$thumb = $user->get('imagen'); }else { $thumb ='images/empleados/sin_foto.png';}
                               echo '<img src="'.htmlspecialchars($resizer->resize($thumb, array('h' =>29))).'" alt=""/>';
                               ?>
                                <span class="username">
                                <?php 
                                $params = JFactory::getApplication()->getTemplate(true)->params;
                                $user = JFactory::getUser();
                                if ($params->get('name') == 0) : {
                                        echo htmlspecialchars($user->get('name'));
                                } else : {
                                        echo htmlspecialchars($user->get('username'));
                                } endif; ?>
                                </span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
                               <li><a href="<?php echo JRoute::_('index.php?option=com_users&view=profile&layout=edit');?>"><i class="icon-user"></i> Editar Perfil</a></li>
                               <li><a href="<?php echo JRoute::_('index.php?option=com_users&task=user.logout&'.JSession::getFormToken() .'=1&return='.base64_encode(JRoute::_('index.php')));?>"><i class="icon-key"></i> Salir</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
        <?php if ($this->countModules('position-8')) : ?>
        <!-- Begin Sidebar -->
        <jdoc:include type="modules" name="position-8" style="xhtml" />
        <!-- End Sidebar -->
        <?php endif; ?>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <jdoc:include type="modules" name="position-2" style="none" />
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                    <main id="content" role="main" class="<?php echo $span;?>">
                            <!-- Begin Content -->
                            <jdoc:include type="message" />
                            <jdoc:include type="modules" name="position-3" style="xhtml" />
                            <jdoc:include type="component" />
                            <!-- End Content -->       
                    </main>
                    <?php if ($this->countModules('position-7')) : ?>
                    <div id="aside" class="span3">
                            <!-- Begin Right Sidebar -->
                            <jdoc:include type="modules" name="position-7" style="well" />
                            <!-- End Right Sidebar -->
                    </div>
                    <?php endif; ?>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
   <div id="footer">
       Copyright &copy; <?php echo date('Y');?> Limpieza Metroplolitana S.A. E.S.P LIME
   </div>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS -->  
<?php 
$link_jquery= $this->baseurl.'/media/jui/js/jquery.min.js';
 if (!isset($this->_scripts[$link_jquery])) { 
   ?><script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.8.3.min.js"></script>   
<?php } ?>  
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.nicescroll.js"></script>
<!--<script type="text/javascript" src="<?php //echo $this->baseurl ?>/templates/<?php //echo $this->template ?>/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>


<?php 
$link_bootstrap= $this->baseurl.'/media/jui/js/bootstrap.min.js';
echo $link_bootstrap;
 if (!isset($this->_scripts[$link_bootstrap])) { 
   ?><script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<?php } ?>  
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/excanvas.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/respond.js"></script>
<![endif]-->
   
  <!--common script for all pages-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.sparkline.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/chart-master/Chart.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/common-scripts.js"></script>

   <!--script for this page only-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/easy-pie-chart.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/sparkline-chart.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/home-page-calender.js"></script>
<!--<script type="text/javascript" src="<?php //echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/chartjs.js"></script>-->

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
<?php
}endif;
?>