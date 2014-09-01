<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.html.parameter' );

$menu_id = 'bj_list_menu_'.rand(0,1000);
define('_MENU_ID_',$menu_id);
global $Itemid;
$Itemid = JRequest::getVar('Itemid','');
// make sure that functions are defined one time only
if (!defined('_BJ_LIST_MENU_FUNC_INCLUDED')) {
	define('_BJ_LIST_MENU_FUNC_INCLUDED', 1);

	/**
	* Function for writing a menu link
	*/
	function bjGetMenuLink($mitem, $level=0, &$params, $open=null) {
		global $Itemid;
		$mosConfig_live_site = JUri::base(true);
		$mainframe = JFactory::getApplication();
		$txt = '';
		switch ($mitem->type) {
			case 'separator':
			case 'component_item_link':
				break;
			case 'url':
				if (eregi('index.php\?', $mitem->link)) {
					if (!eregi('Itemid=', $mitem->link)) {
						$mitem->link .= '&Itemid='. $mitem->id;
					}
				}
				break;

			case 'content_item_link':
			case 'content_typed':
				// load menu params
				$menuparams = new JParameter($mitem->params, $mainframe->getPath('menu_xml', $mitem->type), 'menu');
				$unique_itemid = $menuparams->get('unique_itemid', 1);

				if ($unique_itemid) {
					$mitem->link .= '&Itemid='. $mitem->id;
				} else {
					$temp = split('&task=view&id=', $mitem->link);

					if ($mitem->type == 'content_typed') {
						$mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 1, 0);
					} else {
						$mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 0, 1);
					}
				}
				break;
			case 'alias':
				// If this is an alias use the item id stored in the parameters to make the link.
				$menuparams = new JParameter($mitem->params);
				$mitem->link = 'index.php?Itemid='.$menuparams->get('aliasoptions');
				break;
			default:
				$mitem->link .= '&Itemid='. $mitem->id;
				break;
		}
		// Active Menu highlighting
		$hl = '"';
		if ($params->get('active_id')) {
			// determine CSS selector to use for active highlighting
			if ($params->get('legacy_mode')) {
				$highlight = '" id="active_menu'. $params->get('menuclass_sfx') .'"';
			} else {
				$highlight = ' active_mitem'. $params->get('menuclass_sfx') .'"';
			}

			$current_itemid = $Itemid;
			if (!$current_itemid) {
				// do nothing
			} elseif ($current_itemid == $mitem->id) {
				$hl = $highlight;
			} elseif ($params->get('activate_parent') && isset($open) && in_array($mitem->id, $open))  {
				$hl = $highlight;
			}

			if ($params->get('full_active_id')) {
				// support for `active_menu` of `Link - Component Item`
				if ($hl == '"' && $mitem->type == 'component_item_link') {
					parse_str($mitem->link, $url);
					if ($url['Itemid'] == $current_itemid) {
						$hl = $highlight;
					}
				}

				// support for `active_menu` of `Link - Url` if link is relative
				if ($hl == '"' && $mitem->type == 'url' && strpos('http', $mitem->link) === false) {
					parse_str($mitem->link, $url);
					if (isset($url['Itemid'])) {
						if ($url['Itemid'] == $current_itemid) {
							$hl = $highlight;
						}
					}
				}
			}
		}

		// replace & with amp; for xhtml compliance
		$mitem->link = JFilterOutput::ampReplace($mitem->link);

		// run through SEF convertor
		$mitem->link = JRoute::_($mitem->link);

		// remove slashes from escaped characters
		$mitem->name = stripslashes(JFilterOutput::ampReplace($mitem->title));

		// build <a> tag
		$menuclass = ($level == 0 ? 'mainlevel_'.$level : 'sublevel_'.$level) . $params->get('menuclass_sfx');
		switch ($mitem->browserNav) {
			// cases are slightly different
			case 1:
				// open in a new window
				$txt = '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass . $hl .'>'. $mitem->name .'</a>';
				break;

			case 2:
				// open in a popup window
				$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass". $hl .">". $mitem->name ."</a>\n";
				break;

			case 3:
				// don't link it
				$txt = '<span class="'. $menuclass . $hl .'>'. $mitem->name .'</span>';
				break;

			default:
				// open in parent window
				$txt = '<a href="'. $mitem->link .'" class="'. $menuclass . $hl .'>'. $mitem->name .'</a>';
				break;
		}

		// attach menu image if enable
		if ($params->get('menu_images')) {
			$menu_params = new JForm($mitem->params);
			$menu_image	= -1;

			if (($menu_image != '-1') && $menu_image) {
				$image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $menu_image .'" border="0" alt="'. $mitem->name .'" />';
				if ($params->get('menu_images_align')) {
					$txt = $txt . $image;
				} else {
					$txt = $image . $txt;
				}
			}
		}
		return $txt = $txt;
	}

	/**
	* Utility function to recursively work through a multi-level menu system
	*/
	function bjRecurseMenu($id, $level, &$children, &$open, &$params) {
		if (@$children[$id]) { // has child?
			$tabs = '';
			$root_items ='';
			if ($level == 0) {
				// count root-menu items
				$root_items = 0;

				// determine CSS selector to use for root <ul> tag
				if ($params->get('legacy_mode')) {
					$menuSign = 'id="mainlevel_'.$level.'" class="list_menu'. $params->get('menuclass_sfx') .'"';
				} else {
					$menuSign = 'id="'._MENU_ID_.'" class="list_menu'. $params->get('menuclass_sfx') .'"';
				}
				echo '<div class="menu-trigger">Menu</div>';
			} else {
				// count tabs
				echo '<div class="sub-menu-trigger"></div>';
				for ($i = 0; $i < $level; $i++) {
					$tabs .= "\t";
				}
			}			
			
			echo "<ul". ($level == 0 ? " $menuSign" : '') .">";
			$index = 0;			
			foreach ($children[$id] as $row) { // list all childs
				
				// if root-menu items counted reachs limit?
				if ($level == 0 AND $params->get('rootmenu_count') AND $root_items >= $params->get('rootmenu_count'))
					break;
			
				$link = bjGetMenuLink($row, $level, $params, $open);
				$itemId = "";
				if($root_items == $params->get('rootmenu_count') -1) $itemId = "last_item";
				if (preg_match("/active_(mitem|menu)/", $link)) {
					// found active menu item, add highlight sign to <li> tag
					
					echo "\n$tabs".'<li class="tl_item'.$index.' '.$itemId.' active_mitem active'. $params->get('menuclass_sfx') .'">';
				} else {
					echo "\n$tabs<li class='tl_item".$index." ".$itemId."'>";
				}
				echo $link;
				$index = $index + 1;
				// is displaying of sub-menu enabled?
				if ($params->get('submenu_deep') > 0) {
					if (!$params->get('expand_all')) {
						// show sub-menu only for active root-menu item
						if (in_array($row->id, $open)) {
							bjRecurseMenu($row->id, $level+1, $children, $open, $params);
						}
					} else {
						// show all sub-menus
						bjRecurseMenu($row->id, $level+1, $children, $open, $params);
					}
				}
				echo "</li>";

				// count root-menu items
				if ($level == 0 AND $params->get('rootmenu_count'))
					$root_items++;
			}
			echo "$tabs</ul>\n";
		}
	}

	/**
	* Function to draw hierarchycal list style menu system
	*/
	function bjShowMenu(&$params) {
		global $Itemid;
		global $mosConfig_shownoauth;
		$mosConfig_live_site = JUri::base(true);
		$database  = JFactory::getDBO();
		$mainframe = JFactory::getApplication();
		$my = JFactory::getUser();
		$groups = implode(',', $my->getAuthorisedViewLevels());

		// check if data already queried
		$rows = $mainframe->get($params->get('menutype').'_items');

		// if data not already queried
		if (!$rows) {
			// get menu data
			$and = '';
			if (!$mosConfig_shownoauth) {
				$and = "\n AND `access` in (".$groups.")";
			}
			$sql = "SELECT * FROM #__menu"
			. "\n WHERE menutype = '". $params->get('menutype') ."'"
			. "\n AND published = 1"
			. $and
			. "\n ORDER BY parent_id, lft"
			;
			$database->setQuery($sql);
			//echo $database->getQuery();
			$rows = $database->loadObjectList('id');
			// store data to mainframe object
			$mainframe->set($params->get('menutype').'_items', $rows);
		}

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		
		foreach ($rows as $v) {
			$pt		= $v->parent_id;
			$list	= @$children[$pt] ? $children[$pt] : array();
			array_push($list, $v);
			$children[$pt] = $list;
		}
		//print_r($children);
		// is displaying of sub-menu enabled?
		if ($params->get('submenu_deep') > 0) {
			// second pass - collect 'open' menus
			$open	= array($Itemid);
			$count	= $params->get('submenu_deep'); // max sub-menu deep
			$id		= $Itemid;
			while ($count--) {
				if (isset($rows[$id]) && $rows[$id]->parent_id > 0) {
					$id = $rows[$id]->parent_id;
					$open[] = $id;
				} else {
					break;
				}
			}
		}

$MODULE_URL = JURI::base() . "modules/mod_bj_dropdown_menu";
?>
<?php if(!defined('BJ_LIST_MENU_LIB_LOADED')){

$document = JFactory::getDocument();
$document->addStyleSheet($MODULE_URL.'/style/bj_dropdown_menu_'.$params->get('themes').'.css');
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	(function(){
			/* Mobile */		
			jQuery(".menu-trigger").on("click", function(){
				//jQuery("ul.list_menu").toggleClass("bj-menu-mobile");
				jQuery(this).next().toggleClass("bj-menu-mobile");
			});
			jQuery(".sub-menu-trigger").on("click", function(){
				jQuery(this).toggleClass("active");
				jQuery(this).next().toggleClass("bj-menu-mobile");
			});
			// iPad
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			if (isiPad) jQuery('ul.list_menu ul').addClass('no-transition');      
	})(); 
});
</script>
<?php 
define('BJ_LIST_MENU_LIB_LOADED',1);
}
		// build hierarchycal list
		bjRecurseMenu(1, 0, $children, $open, $params);
	}
}

// show the hierarchycal list menu
bjShowMenu($params);
?>