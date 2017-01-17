<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$title      = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';
$anchor_css = $item->anchor_css ? $item->anchor_css : '';

$linktype   = $item->title;

if ($item->menu_image)
{
	$linktype = JHtml::_('image', $item->menu_image, $item->title);

	if ($item->params->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

if ($item->deeper)
{
	echo '<a class="separator dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" '. $title  .'>'. $linktype .'<span class="caret"></span></a>';
}
else
{
	echo '<a class="separator'. $anchor_css .'"'. $title  .'>'. $linktype .'</a>';
}