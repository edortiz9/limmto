<?php

/**
 * @package     Extly.Modules
 * @subpackage  JBDropDownMenu - Menu based on Twitter's Bootstrap, Subnav, Nav Nav-pills, with Dropdown Menu
 *
 * @author      Prieco S.A. <support@extly.com>
 * @copyright   Copyright (C) 2007 - 2012 Prieco, S.A. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @link        http://www.extly.com http://support.extly.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

// Note. It is important to remove spaces between elements.
?>

<div id="sidebar" class="<?php echo $class_sfx; ?>">

	<ul class="sidebar-menu"
		<?php
		$tag = '';

		if ($params->get('tag_id') != null)
		{
			$tag = $params->get('tag_id') . '';
			echo ' id="' . $tag . '"';
		}

		?>>
			<?php
			foreach ($list as $i => &$item)
			{
				$class = 'sub-menu item-' . $item->id;

				if ($item->id == $active_id)
				{
					$class .= ' current';
				}

				if (in_array($item->id, $path))
				{
					$class .= ' active';
				}
				elseif ($item->type == 'alias')
				{
					$aliasToId = $item->params->get('aliasoptions');

					if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
					{
						$class .= ' active';
					}
					elseif (in_array($aliasToId, $path))
					{
						$class .= ' alias-parent-active';
					}
				}

				if ($item->deeper)
				{
					$class .= ' deeper dropdown';
				}

				if ($item->parent)
				{
					$class .= ' parent';
				}

				if (!empty($class))
				{
					$class = ' class="' . trim($class) . '"';
				}

				echo '<li' . $class . '>';

				// Render the menu item.
				switch ($item->type)
				{
					case 'separator':
					case 'url':
					case 'component':
						require JModuleHelper::getLayoutPath('mod_jbmenu', 'default_' . $item->type);
						break;

					default:
						require JModuleHelper::getLayoutPath('mod_jbmenu', 'default_url');
						break;
				}

				// The next item is deeper.
				if ($item->deeper)
				{
					echo '<ul class="sub">';
				}
				// The next item is shallower.
				elseif ($item->shallower)
				{
					echo '</li>';
					echo str_repeat('</ul></li>', $item->level_diff);
				}
				// The next item is on the same level.
				else
				{
					echo '</li>';
				}
			}
			?></ul>

</div>