<?php
/**
 * @package         Advanced Template Manager
 * @version         1.1.5
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2014 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of template styles.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_templates
 * @since       1.6
 */
class AdvancedTemplatesViewTemplates extends JViewLegacy
{
	/**
	 * @var		array
	 * @since   1.6
	 */
	protected $items;

	/**
	 * @var		object
	 * @since   1.6
	 */
	protected $pagination;

	/**
	 * @var		object
	 * @since   1.6
	 */
	protected $state;

	/**
     * @var		string
     * @since   3.2
     */
	protected $file;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 * @since   1.6
	 */
	public function display($tpl = null)
	{
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state      = $this->get('State');
		$this->preview    = JComponentHelper::getParams('com_templates')->get('template_positions_display');
		$this->file       = base64_encode('home');
		$this->filterForm    = $this->get('FilterForm');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

		// Check if there are no matching items
		if (!count($this->items))
		{
			JFactory::getApplication()->enqueueMessage(
				JText::_('COM_TEMPLATES_MSG_MANAGE_NO_TEMPLATES'),
				'warning'
			);
		}

		$this->getConfig();
		$this->addToolbar();
		return parent::display($tpl);
	}

	/**
	 * Function that gets the config settings
	 *
	 * @return    Object
	 */
	protected function getConfig()
	{
		if (!isset($this->config))
		{
			require_once JPATH_PLUGINS . '/system/nnframework/helpers/parameters.php';
			$parameters = NNParameters::getInstance();
			$this->config = $parameters->getComponentParams('advancedtemplates');
		}
		return $this->config;
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_templates');

		if($this->config->heading_title)
		{
			JToolbarHelper::title(JText::_('COM_TEMPLATES_MANAGER_TEMPLATES'), 'eye thememanager');
		} else {
			JToolbarHelper::title(JText::sprintf('ATM_HEADING', JText::_('COM_TEMPLATES_SUBMENU_TEMPLATES')), 'advancedtemplatemanager icon-nonumber');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_advancedtemplates');
			JToolbarHelper::divider();
		}

		JToolbarHelper::help('JHELP_EXTENSIONS_TEMPLATE_MANAGER_TEMPLATES');
	}
}
