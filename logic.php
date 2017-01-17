<?php defined( '_JEXEC' ) or die; 

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$menu = $app->getMenu();
$active = $app->getMenu()->getActive();
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;
$templateparams	= $app->getTemplate(true)->params;
$sitename = $app->get('sitename');
$this->language  = $doc->language;
$this->direction = $doc->direction;

// generator tag
$this->setGenerator(null);

// force latest IE & chrome frame
$doc->setMetadata('x-ua-compatible','IE=edge,chrome=1');

// Remove Scripts
unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
unset($doc->_scripts[JURI::root(true) . '/media/system/js/core.js']);
unset($doc->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
unset($doc->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);


// js
JHtml::_('jquery.framework');
$doc->addScript($tpath.'/js/bootstrap.min.js');
$doc->addScript($tpath.'/js/logic.js'); // <- use for custom script

// css
if ($templateparams->get('runless', 1) == 1)
{
	require 'css/lesscompiler/runless.php';
}

$doc->addStyleSheet($tpath.'/css/template.css');

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


