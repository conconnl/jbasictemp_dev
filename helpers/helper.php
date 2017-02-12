<?php
// Prevent direct access
defined('_JEXEC') or die();

// Connect with Joomla
$app            = JFactory::getApplication();
$doc            = JFactory::getDocument();
$session        = JFactory::getSession();
$juser          = JFactory::getUser();

// Get variables
$option         = $app->input->getCmd('option', '');
$view           = $app->input->getCmd('view', '');
$layout         = $app->input->getCmd('layout', '');
$task           = $app->input->getCmd('task', '');
$itemid         = $app->input->getCmd('Itemid', '');
$id             = $app->input->getCmd('id', '');
$sitename       = $app->getCfg('sitename');
$menu           = $app->getMenu();
$menu_active    = $menu->getActive();
$frontpage      = ($menu_active == $menu->getDefault() ? true : false);
$templateparams = $app->getTemplate(true)->params;
$templateUrl    = $this->baseurl.'/templates/'.$this->template;
$templateDir    = JPATH_THEMES . '/' . $this->template . '/';
$siteDir        = JPATH_ROOT;

// Get pageclass
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');

// Set MetaData
$doc->setMetadata('x-ua-compatible','IE=edge,chrome=1');
$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0' );
$doc->setMetaData('content-type', 'text/html', true );
$doc->setGenerator($sitename);

// Call JavaScript to be able to unset it correctly
JHtml::_('behavior.framework');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.tooltip');

// Unset unwanted JavaScript
unset($this->_scripts[$this->baseurl . '/media/system/js/mootools-core.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/mootools-more.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/caption.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/core.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/validate.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/modal.js']);
unset($this->_scripts[$this->baseurl . '/media/jui/js/jquery.min.js']);
unset($this->_scripts[$this->baseurl . '/media/jui/js/jquery-noconflict.js']);
unset($this->_scripts[$this->baseurl . '/media/jui/js/jquery-migrate.min.js']);
unset($this->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']);
unset($this->_scripts[$this->baseurl . '/media/system/js/tabs-state.js']);

if (isset($this->_script['text/javascript']))
{
    $this->_script['text/javascript'] = preg_replace('%jQuery\(window\)\.on\(\'load\'\,\s*function\(\)\s*\{\s*new\s*JCaption\(\'img.caption\'\);\s*}\s*\);\s*%', '', $this->doc->_script['text/javascript']);
    $this->_script['text/javascript'] = preg_replace("%\s*jQuery\(document\)\.ready\(function\(\)\{\s*jQuery\('\.hasTooltip'\)\.tooltip\(\{\"html\":\s*true,\"container\":\s*\"body\"\}\);\s*\}\);\s*%", '', $this->doc->_script['text/javascript']);
    $this->_script['text/javascript'] = preg_replace('%\s*jQuery\(function\(\$\)\{\s*\$\(\"\.hasTooltip\"\)\.tooltip\(\{\"html\":\s*true,\"container\":\s*\"body\"\}\);\s*\}\);\s*%', '', $this->doc->_script['text/javascript']);

    // Unset completly if empty
    if (empty($this->_script['text/javascript']))
    {
        unset($this->_script['text/javascript']);
    }
}

// Add Scripts & StyleSheets
// js
JHtml::_('jquery.framework');
$doc->addScript($templateUrl.'/js/bootstrap.min.js');
$doc->addScript($templateUrl.'/js/logic.js'); // <- use for custom script

// css
if ($templateparams->get('runless', 1) == 1)
{
	require ('templates/' . $this->template . '/css/lesscompiler/runless.php');
}

$doc->addStyleSheet($templateUrl.'/css/template.css');

// Template parameters specific configurations
// Use chosen Logo, Site Title or sitename
if ($this->params->get('logoFile'))
{
    $logo = '<a class="logo" href="'. JURI::root() .'"><img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" /></a>';
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
    $leftsidebar = "col-sm-2";
    $rightsidebar = "col-sm-2";
    $componentarea = "col-sm-8";
}
elseif ($this->countModules('leftsidebar') or $this->countModules('rightsidebar'))
{
    $leftsidebar = "col-sm-3";
    $rightsidebar = "col-sm-3";
    $componentarea = "col-sm-9";
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


