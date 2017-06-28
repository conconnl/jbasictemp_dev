<?php
/*
 * @package     Basic template
 * @copyright   Copyright (c) Joomla Community Netherlands
 * @license     GNU General Public License version 3 or later
 */

// No direct access.
defined('_JEXEC') or die;

// Load Basic Template Helper
require_once JPATH_THEMES . '/' . $this->template . '/helpers/helper.php';

BasicTemplateHelper::setMetadata();
BasicTemplateHelper::setFavicon();
BasicTemplateHelper::unloadCss();
BasicTemplateHelper::unloadJs();
BasicTemplateHelper::loadCss();
BasicTemplateHelper::loadJs();
BasicTemplateHelper::loadApplIcon();
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="head"/>
</head>

<body class="<?php echo BasicTemplateHelper::getBodySuffix(); ?>" role="document">
<?php BasicTemplateHelper::putAnalyticsTrackingCode(); ?>
<div class="<?php echo $containerstyle; ?>">
    <div class="row headerbar">
		<?php echo $logo; ?>
    </div>

    <!-- Begin Navbar -->
	<?php if ($this->countModules('navbar')) : ?>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div id="navbar" class="navbar-collapse collapse">
                    <jdoc:include type="modules" name="navbar"/>
                </div>
            </div>
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </nav>
	<?php endif; ?>
    <!-- End Navbar-->

    <div class="row">
        <!-- Begin Component Area -->
        <div class="<?php echo $componentarea; ?>">
            <jdoc:include type="message"/>
            <jdoc:include type="component"/>
        </div>
        <!-- End Component Area -->
        <!-- Begin Left Sidebar -->
		<?php if ($this->countModules('leftsidebar')) : ?>
            <div class="<?php echo $leftsidebar; ?>">
                <div class="leftsidebar">
                    <jdoc:include type="modules" name="leftsidebar" style="xhtml"/>
                </div>
            </div>
		<?php endif; ?>
        <!-- End Left Sidebar -->
        <!-- Begin Right Sidebar -->
		<?php if ($this->countModules('rightsidebar')) : ?>
            <div class="<?php echo $rightsidebar; ?>">
                <div class="rightsidebar">
                    <jdoc:include type="modules" name="rightsidebar" style="xhtml"/>
                </div>
            </div>
		<?php endif; ?>
        <!-- End Right Sidebar -->
    </div>


    <!-- Footer -->
    <footer class="row" role="contentinfo">
        <div class="row">
			<?php if ($this->countModules('footerblock1')) : ?>
                <div class="<?php echo $footerblock; ?>">
                    <jdoc:include type="modules" name="footerblock1" style="xhtml"/>
                </div>
			<?php endif; ?>
			<?php if ($this->countModules('footerblock2')) : ?>
                <div class="<?php echo $footerblock; ?>">
                    <jdoc:include type="modules" name="footerblock2" style="xhtml"/>
                </div>
			<?php endif; ?>
			<?php if ($this->countModules('footerblock3')) : ?>
                <div class="<?php echo $footerblock; ?>">
                    <jdoc:include type="modules" name="footerblock3" style="xhtml"/>
                </div>
			<?php endif; ?>
        </div>
        <div class="row">
            <div class="<?php echo $footermodule; ?>">
                <jdoc:include type="modules" name="footer" style="xhtml"/>
            </div>
			<?php if ($this->params->get('totop') == 1): ?>
                <div class="<?php echo $totopicon; ?>">
                    <a href="#">
					<span class="fa-stack fa-2x">
  						<i class="fa fa-circle-thin fa-stack-2x" aria-hidden="true"></i>
  						<i class="fa fa-angle-up fa-stack-1x" aria-hidden="true"></i>
					</span>
                    </a>
                </div>
			<?php endif; ?>
        </div>
    </footer>
    <!-- End Footer -->
    <jdoc:include type="modules" name="debug" style="none"/>
</div>
</body>
</html>
