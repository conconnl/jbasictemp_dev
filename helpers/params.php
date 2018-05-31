<?php
/**
 * @package     Basic template
 * @copyright   Copyright (c) Joomla Community Netherlands
 * @license     GNU General Public License version 3 or later
 * @version     1.0
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$config         = Factory::getConfig();
$sitename       = $config->get('sitename');

// Body / HTML / Container
$containerstyle     = $this->params->get('containerstyle', '');
$backtotopshow      = $this->params->get('backtotopshow', 1);
$homepagecomponent  = $this->params->get('homepagecomponent', 0);
//Toolbar
$toolbarcolor       = $this->params->get('toolbarcolor', '');
$toolbarcontainerstyle     	= $this->params->get('toolbarcontainerstyle', '');
$toolbarphone     	= $this->params->get('toolbarphone', '');
// Navbar
$navcolor     		= $this->params->get('navcolor', '');
$navwidth     		= $this->params->get('navwidth', '');
$menualign			= $this->params->get('menualign', '');
$stickymenu     	= $this->params->get('stickymenu', '');
$stickymenuoffset  	= $this->params->get('stickymenuoffset', 0);
$navbarmobile       = $this->params->get('navbarmobile','');
// Logo
$logoposition       = $this->params->get('logoposition', '');
// Slideshow
$slideshowcolor     = $this->params->get('slideshowcolor', '');
$slideshowpadding   = $this->params->get('slideshowpadding', '');
$slideshowwidth     = $this->params->get('slideshowwidth', '');
$slideshowphone     = $this->params->get('slideshowphone', '');
// Breadcrumbs
$breadcrumbscolor   = $this->params->get('breadcrumbscolor', '');
$breadcrumbspadding = $this->params->get('breadcrumbspadding', '');
$breadcrumbswidth  	= $this->params->get('breadcrumbswidth', '');
$breadcrumbsphone   = $this->params->get('breadcrumbsphone', '');
// Top
$topacolor     		= $this->params->get('topacolor', '');
$topapadding   		= $this->params->get('topapadding', '');
$topawidth     		= $this->params->get('topawidth', '');
$topaphone     		= $this->params->get('topaphone', '');
$topbcolor     		= $this->params->get('topbcolor', '');
$topbpadding   		= $this->params->get('topbpadding', '');
$topbwidth     		= $this->params->get('topbwidth', '');
$topbphone    		= $this->params->get('topbphone', '');
$topccolor     		= $this->params->get('topccolor', '');
$topcpadding   		= $this->params->get('topcpadding', '');
$topcwidth     		= $this->params->get('topcwidth', '');
$topcphone     		= $this->params->get('topcphone', '');
$topdcolor     		= $this->params->get('topdcolor', '');
$topdpadding   		= $this->params->get('topdpadding', '');
$topdwidth     		= $this->params->get('topdwidth', '');
$topdphone     		= $this->params->get('topdphone', '');
// Mainbody
$mainbodycolor      = $this->params->get('mainbodycolor', '');
$mainbodypadding 	= $this->params->get('mainbodypadding', '');
$mainbodywidth 		= $this->params->get('mainbodywidth', '');
$leftwidth          = $this->params->get('leftwidth', '');
$rightwidth         = $this->params->get('rightwidth', '');
// Bottom
$bottomacolor     	= $this->params->get('bottomacolor', '');
$bottomapadding   	= $this->params->get('bottomapadding', '');
$bottomawidth     	= $this->params->get('bottomawidth', '');
$bottomaphone     	= $this->params->get('bottomaphone', '');
$bottombcolor     	= $this->params->get('bottombcolor', '');
$bottombpadding   	= $this->params->get('bottombpadding', '');
$bottombwidth     	= $this->params->get('bottombwidth', '');
$bottombphone    	= $this->params->get('bottombphone', '');
$bottomccolor     	= $this->params->get('bottomccolor', '');
$bottomcpadding   	= $this->params->get('bottomcpadding', '');
$bottomcwidth     	= $this->params->get('bottomcwidth', '');
$bottomcphone     	= $this->params->get('bottomcphone', '');
$bottomdcolor     	= $this->params->get('bottomdcolor', '');
$bottomdpadding   	= $this->params->get('bottomdpadding', '');
$bottomdwidth     	= $this->params->get('bottomdwidth', '');
$bottomdphone     	= $this->params->get('bottomdphone', '');

// Template parameters specific configurations
// Use chosen Logo, Site Title or sitename
if ($this->params->get('logoFile'))
{
    $logo = '<a class="logo" href="'. JURI::root() .'"><img class="img-responsive" src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" /></a>';
}
elseif ($this->params->get('sitetitle'))
{
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}