<?php
/**
 * Fileupload plugin element to render mov file types
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.element.fileupload
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_SITE . '/plugins/fabrik_element/fileupload/models/video.php';
$render = new videoRender;
