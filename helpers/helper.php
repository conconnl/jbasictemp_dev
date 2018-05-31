<?php
/**
 * @package     Basic template
 * @copyright   Copyright (c) Joomla Community Netherlands
 * @license     GNU General Public License version 3 or later
 * @version     1.0
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Environment\Browser;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;

// Get Parameters configuration from templateDetails
require_once JPATH_THEMES . '/' . $this->template . '/helpers/params.php';

// css
if ($this->params->get('runless', 1) == 1)
{
	require ('templates/' . $this->template . '/helpers/lesscompiler/runless.php');
}

// Calculate component width
$componentwidth = '';
$grid = 12;

if ($this->countModules('left') && $this->countModules('right'))
{
	$componentwidth = ($grid - ($leftwidth + $rightwidth));
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$componentwidth = ($grid - $leftwidth);
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$componentwidth = ($grid - $rightwidth);
}
elseif (!$this->countModules('left') && !$this->countModules('right'))
{
	$componentwidth = $grid;
}

class BasicTemplateHelper
{
    static public function template()
    {
        return Factory::getApplication()->getTemplate();
    }

    /**
    * Method to manually override the META-generator
    * @since BasicTemplate 1.0
    */
    static public function setGenerator($generator)
    {
        Factory::getDocument()->setGenerator($generator);
    }

    /**
     * Method to get the current sitename
     * @since BasicTemplate 1.0
     */
    static public function getSitename()
    {
        return Factory::getConfig()->get('sitename');
    }

    /**
     * Method to set some Meta data
     * @since BasicTemplate 1.0
     */
    static public function setMetadata()
    {
        $doc    = Factory::getDocument();

        $doc->setCharset('utf-8');
        $doc->setMetaData('X-UA-Compatible', 'IE=edge', true);
        $doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
        $doc->setMetaData('content-type', 'text/html', true );
        $doc->setMetaData('mobile-web-app-capable', 'yes');
        $doc->setMetaData('apple-mobile-web-app-capable', 'yes');
        $doc->setMetaData('apple-mobile-web-app-status-bar-style', 'black');
        $doc->setMetaData('apple-mobile-web-app-title', self::getSitename());
        self::setGenerator(self::getSitename());
    }

    /**
     * Method to set Favicon
     * @since BasicTemplate 1.0
     */
    static public function setFavicon()
    {
        $doc = Factory::getDocument();

        $doc->addHeadLink('templates/' . self::template() . '/images/favicon.ico', 'shortcut icon', 'rel', array('type' => 'image/ico'));
        $doc->addHeadLink('templates/' . self::template() . '/images/favicon.png', 'shortcut icon', 'rel', array('type' => 'image/png'));
    }

    /**
     * Method to return the current Menu Item ID
     * @since BasicTemplate 1.0
     */
    static public function getItemId()
    {
        return Factory::getApplication()->input->getInt('Itemid');
    }

    /** Generate the needed information for the GetBodySuffix */
    /**
     * Method to fetch the current path
     * @since BasicTemplate 1.0
     */
    static public function getPath($output = 'array')
    {
        $uri  = URI::getInstance();
        $path = $uri->getPath();
        $path = preg_replace('/^\//', '', $path);
        if ($output == 'array')
        {
            $path = explode('/', $path);

            return $path;
        }

        return $path;
    }

    /**
     * get PageClass set with Menu Item
     * @since BasicTemplate 1.0
     */
    static public function getPageClass()
    {
        $activeMenu = Factory::getApplication()->getMenu()->getActive();
        $pageclass  = ($activeMenu) ? $activeMenu->params->get('pageclass_sfx', '') : '';

        return $pageclass;
    }

    /**
     * @since BasicTemplate 1.0
     */
    static public function getPageOption()
    {
        $input = Factory::getApplication()->input;

        return str_replace('_', '-', $input->getCmd('option', ''));
    }

    /**
     * @since BasicTemplate 1.0
     */
    static public function getPageView()
    {
        $input = Factory::getApplication()->input;

        return str_replace('_', '-', $input->getCmd('view', ''));
    }

    /**
     * @since BasicTemplate 1.0
     */
    static public function getPageLayout()
    {
        $input = Factory::getApplication()->input;

        return str_replace(self::template(), '', $input->getCmd('layout', ''));
    }

    /**
     * @since BasicTemplate 1.0
     */
    static public function getPageTask()
    {
        $input = Factory::getApplication()->input;

        return str_replace('_', '', $input->getCmd('task', ''));
    }
    /**
     * Method to determine whether the current page is the Joomla! homepage
     * @since BasicTemplate 1.0
     */
    static public function isHome()
    {
        // Fetch the active menu-item
        $activeMenu = Factory::getApplication()->getMenu()->getActive();

        // Return whether this active menu-item is home or not
        return (boolean) ($activeMenu) ? $activeMenu->home : false;
    }

	/**
	 * Method to determine whether the current visitor is logged in or not
	 * @since BasicTemplate 2.0
	 */
	static public function isMember()
	{
		// Fetch the active visitor
		$activeMember = Factory::getUser()->guest;

		// Return whether this active visitor is guest or not
		return (boolean) ($activeMember) ? $activeMember : false;
	}

	/**
	 * @since BasicTemplate 2.0
	 */

	static public function getParent()
	{
		// Fetch the active menu-item
		$activeMenu = Factory::getApplication()->getMenu()->getActive();
		// Get the parent menu-item from the active menu-item
		$parentId   = $activeMenu->tree[0];
		// Get alias from the parent menu-item
		$menu       = Factory::getApplication()->getMenu();
		$parentName = $menu->getItem($parentId)->alias;

		return $parentName;
	}

	/**
	 * @since BasicTemplate 2.0
	 */

	static public function getLanguage()
	{
		// Fetch the active language
		$lang       = Factory::getLanguage();
		// Get the active language-tag
		$langTag    = $lang->getTag();

		return $langTag;
	}

    /**
     * Generate a list of useful CSS classes for the body
     * @since  BasicTemplate 1.0
     */
    static public function getBodySuffix()
    {
        $classes   = array();
        $classes[] = 'option-' . self::getPageOption();
        $classes[] = 'view-' . self::getPageView();
        $classes[] = self::getPageLayout() ? 'layout-' . self::getPageLayout() : 'no-layout';
        $classes[] = self::getPageTask() ? 'task-' . self::getPageTask() : 'no-task';
        $classes[] = 'itemid-' . self::getItemId();
        $classes[] = self::getPageClass();
        $classes[] = self::isHome() ? 'path-home' : 'path-' . implode('-', self::getPath('array'));
        $classes[] = 'home-' . (int) self::isHome();

        return implode(' ', $classes);
    }

    /**
     * Remove unwanted CSS
     * @since  BasicTemplate 1.0
     */
    static public function unloadCss()
    {
        $doc = Factory::getDocument();

        $unset_css = array('com_finder');
        foreach ($doc->_styleSheets as $name => $style)
        {
            foreach ($unset_css as $css)
            {
                if (strpos($name, $css) !== false)
                {
                    unset($doc->_styleSheets[$name]);
                }
            }
        }
    }

    /**
     * Load CSS
     * @since  BasicTemplate 1.0
     */
    static public function loadCss()
    {
        HTMLHelper::_('stylesheet', 'templates/' . self::template() . '/css/template.css', array('version' => 'auto'));
    }

    /**
     * Remove unwanted JS
     * @since  BasicTemplate 1.0, changed 2.0
     */
	static public function unloadJs()
	{
		$doc = Factory::getDocument();

		// Call JavaScript to be able to unset it correctly
		HTMLHelper::_('behavior.framework');
		HTMLHelper::_('bootstrap.framework');
		HTMLHelper::_('jquery.framework');
		HTMLHelper::_('bootstrap.tooltip');

		// Unset unwanted JavaScript
		unset($doc->_scripts[$doc->baseurl . '/media/system/js/mootools-core.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/system/js/mootools-more.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/system/js/caption.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/system/js/modal.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/jui/js/jquery-noconflict.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/jui/js/jquery-migrate.min.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/jui/js/bootstrap.min.js']);
		unset($doc->_scripts[$doc->baseurl . '/media/system/js/tabs-state.js']);

		if (isset($doc->_script['text/javascript']))
		{
			$doc->_script['text/javascript'] = preg_replace('%jQuery\(window\)\.on\(\'load\'\,\s*function\(\)\s*\{\s*new\s*JCaption\(\'img.caption\'\);\s*}\s*\);\s*%', '', $doc->_script['text/javascript']);
			$doc->_script['text/javascript'] = preg_replace("%\s*jQuery\(document\)\.ready\(function\(\)\{\s*jQuery\('\.hasTooltip'\)\.tooltip\(\{\"html\":\s*true,\"container\":\s*\"body\"\}\);\s*\}\);\s*%", '', $doc->_script['text/javascript']);
			$doc->_script['text/javascript'] = preg_replace('%\s*jQuery\(function\(\$\)\{\s*\$\(\"\.hasTooltip\"\)\.tooltip\(\{\"html\":\s*true,\"container\":\s*\"body\"\}\);\s*\}\);\s*%', '', $doc->_script['text/javascript']);

			// Unset completely if empty
			if (empty($doc->_script['text/javascript']))
			{
				unset($doc->_script['text/javascript']);
			}
		}
	}

    /**
     * Load JS
     *
     * @since  BasicTemplate 1.0
     */
    static public function loadJs()
    {
        HTMLHelper::_('script', 'media/jui/js/jquery.min.js', array('version' => 'auto'));
        HTMLHelper::_('script', 'templates/' . self::template() . '/js/bootstrap.min.js', array('version' => 'auto'));
        HTMLHelper::_('script', 'templates/' . self::template() . '/js/logic.js', array('version' => 'auto'));
    }

    /**
     * Insert the Google Analytics Tracking code
     * @since  BasicTemplate 2.0
     */
	static public function getAnalytics()
	{
		$doc        = Factory::getDocument();
		$bodyScript = '';
		$useanalytics = Factory::getApplication()->getTemplate(true)->params->get('useanalytics');
		$analytics = Factory::getApplication()->getTemplate(true)->params->get('analytics');
		if (!$analytics)
		{
			return false;
		}
		switch ($useanalytics)
		{
			case 0:
				break;

			case 1:
				// Universal Google Universal Analytics - loaded in head
				$headScript = "
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                    ga('create', '" . $analytics . "', 'auto');
                    ga('send', 'pageview');
                  ";
				$doc->addScriptDeclaration($headScript);
				break;

			case 2:
				// Google Tag Manager - party loaded in head
				$headScript = "
                  <!-- Google Tag Manager -->
                  (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . $analytics . "');
                  <!-- End Google Tag Manager -->
                          ";
				$doc->addScriptDeclaration($headScript);

				// Google Tag Manager - partly loaded directly after body
				$bodyScript = "<!-- Google Tag Manager -->
                    <noscript><iframe src=\"//www.googletagmanager.com/ns.html?id=" . $analytics . "\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
                    <!-- End Google Tag Manager -->
                    ";
				break;

			case 3:
				// Google code for remarketing
				$bodyScript = "
                    <script type=\"text/javascript\">
                    /* <![CDATA[ */
                    var google_conversion_id = " . $analytics . ";
                    var google_custom_params = window.google_tag_params;
                    var google_remarketing_only = true;
                    /* ]]> */
                    </script>
                    <script type=\"text/javascript\" src=\"//www.googleadservices.com/pagead/conversion.js\">
                    </script>
                    <noscript>
                    <div style=\"display:inline;\">
                    <img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"//googleads.g.doubleclick.net/pagead/viewthroughconversion/" . $analytics . "/?guid=ON&amp;script=0\"/>
                    </div>
                    </noscript>
                    ";
				break;
		}
		return $bodyScript;
	}

    static  public function loadAppleIcon()
    {
        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $macOS   = stripos($_SERVER['HTTP_USER_AGENT'],"Macintosh");

        //do something with this information
        if( $iPod || $iPhone || $iPad ){
            $doc = Factory::getDocument();
	        // For non-Retina (@1× display) iPhone, iPod Touch, and Android 2.1+ devices:
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon-57x57.png', 'apple-touch-icon', 'rel', array('type' => 'image/png','sizes' => '57x57'));
	        // For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7:
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon-76x76.png', 'apple-touch-icon', 'rel', array('type' => 'image/png','sizes' => '76x76'));
	        // For iPhone with @2× display running iOS ≥ 7:
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon-120x120.png', 'apple-touch-icon', 'rel', array('type' => 'image/png','sizes' => '120x120'));
	        // For iPad with @2× display running iOS ≥ 7:
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon-152x152.png', 'apple-touch-icon', 'rel', array('type' => 'image/png','sizes' => '152x152'));
	        // For iPhone 6 Plus with @3× display: -->
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon-180x180.png', 'apple-touch-icon', 'rel', array('type' => 'image/png','sizes' => '180x180'));
	        // FallBack
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon.png', 'apple-touch-icon', 'rel', array('type' => 'image/png'));
        }else if($Android){
	        $doc = Factory::getDocument();
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon.png', 'apple-touch-icon', 'rel', array('type' => 'image/png'));
        }else if($webOS){
	        $doc = Factory::getDocument();
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon.png', 'apple-touch-icon', 'rel', array('type' => 'image/png'));
        }else if($macOS){
	        $doc = Factory::getDocument();
	        $doc->addHeadLink('templates/' . self::template() . '/images/apple-touch-icon.png', 'apple-touch-icon', 'rel', array('type' => 'image/png'));
        }
    }


	/**
	 * Load custom font in localstorage
	 *
	 * @since  BasicTemplate 1.0
	 */
	static public function localstorageFont()
	{
		// Keep whitespace below for nicer source code
		$javascript = "    !function(){\"use strict\";function e(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent(\"on\"+t,n)}function t(e){return window.localStorage&&localStorage.font_css_cache&&localStorage.font_css_cache_file===e}function n(){if(window.localStorage&&window.XMLHttpRequest)if(t(o))c(localStorage.font_css_cache);else{var n=new XMLHttpRequest;n.open(\"GET\",o,!0),e(n,\"load\",function(){4===n.readyState&&(c(n.responseText),localStorage.font_css_cache=n.responseText,localStorage.font_css_cache_file=o)}),n.send()}else{var a=document.createElement(\"link\");a.href=o,a.rel=\"stylesheet\",a.type=\"text/css\",document.getElementsByTagName(\"head\")[0].appendChild(a),document.cookie=\"font_css_cache\"}}function c(e){var t=document.createElement(\"style\");t.innerHTML=e,document.getElementsByTagName(\"head\")[0].appendChild(t)}var o=\"/templates/" . self::template() . "/css/font.css\";window.localStorage&&localStorage.font_css_cache||document.cookie.indexOf(\"font_css_cache\")>-1?n():e(window,\"load\",n)}();";
		Factory::getDocument()->addScriptDeclaration($javascript);
	}
}
