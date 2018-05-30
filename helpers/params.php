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

// Navbar
$navcolor     		= $this->params->get('navcolor', '');
$navwidth     		= $this->params->get('navwidth', '');
$menualign			= $this->params->get('menualign', '');
$stickymenu     	= $this->params->get('stickymenu', '');
$stickymenuoffset  	= $this->params->get('stickymenuoffset', 0);


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

// Check Sidebar usage to automatic change the grid
if ($this->countModules('leftsidebar') && $this->countModules('rightsidebar'))
{
    $leftsidebar = "col-xs-12 col-sm-2 col-sm-pull-8";
    $rightsidebar = "col-xs-12 col-sm-2";
    $componentarea = "col-xs-12 col-sm-8 col-sm-push-2";
}
elseif ($this->countModules('rightsidebar'))
{
    $rightsidebar = "col-xs-12 col-sm-3";
    $componentarea = "col-xs-12 col-sm-9";
}
elseif ($this->countModules('leftsidebar'))
{
    $leftsidebar = "col-xs-12 col-sm-3 col-sm-pull-9";
    $componentarea = "col-xs-12 col-sm-9 col-sm-push-3";
}
else
{
    $componentarea = "col-sm-12";
}

// Count to Footerblocks to automatic change the grid
if ($this->countModules('footerblock1') && $this->countModules('footerblock2') && $this->countModules('footerblock3'))
{
    $footerblock = "col-sm-4";
}
elseif (($this->countModules('footerblock1') && $this->countModules('footerblock2')) or ($this->countModules('footerblock1') && $this->countModules('footerblock3')) or ($this->countModules('footerblock2') && $this->countModules('footerblock3')) )
{
    $footerblock = "col-sm-6";
}
else
{
    $footerblock = "col-sm-12";
}

// Display ToTop scroll FontAwesome button
if ($this->params->get('totop') == 1)
{
    $footermodule = 'col-sm-11';
    $totopicon = 'col-sm-1';
}
else
{
    $footermodule = 'col-sm-12';
    $totopicon = '';
}

// Use Container or Container-fluid
if ($this->params->get('containerstyle') == 1)
{
    $containerstyle = 'container-fluid';
}
else
{
    $containerstyle = 'container';
}
