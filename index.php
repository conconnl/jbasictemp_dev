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
BasicTemplateHelper::loadAppleIcon();
BasicTemplateHelper::localstorageFont();
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="head"/>
</head>

<body class="<?php echo BasicTemplateHelper::getBodySuffix(); ?>" role="document">
<?php BasicTemplateHelper::putAnalyticsTrackingCode(); ?>
<div class="<?php echo $containerstyle; ?>">
	<?php if ($logoposition == 'header') :?>
    <div class="headerbar">
		    <?php echo $logo; ?>
    </div>
	<?php endif; ?>


    <!-- Begin Navigation bar -->
	<?php if ($this->countModules('navbar')) : ?>
    <div class="nav-wrapper">
	    <?php if ($navbarmobile == 'collapse') :?>
        <nav class="navbar navbar-default navbar-main <?php echo $navcolor; ?>" role="navigation" <?php if ($stickymenu) : ?> data-spy="affix" data-offset-top="<?php echo $stickymenuoffset; ?>"<?php endif; ?>>
            <div class="<?php echo $navwidth; ?>">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <!-- Logo -->
                    <?php if ($logoposition == 'menu') :?>
	                    <?php echo $logo; ?>
                    <?php endif; ?>
                </div>

                <!-- Desktop Navigation -->
                <div class="navbar-main-menu navbar-<?php echo $menualign; ?>">
                    <jdoc:include type="modules" name="navbar" style="notitle"/>
                </div>

                <!-- Mobile Navigation Collapse -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <div class="navbar-mobile">
                        <jdoc:include type="modules" name="navbar" style="notitle"/>
                    </div>
                </div>
            </div>
        </nav>
	    <?php endif; ?>
	    <?php if ($navbarmobile == 'offcanvas') :?>
            <nav class="navbar navbar-default navbar-main <?php echo $navcolor; ?>" role="navigation" <?php if ($stickymenu) : ?> data-spy="affix" data-offset-top="<?php echo $stickymenuoffset; ?>"<?php endif; ?>>
                <div class="<?php echo $navwidth; ?>">
                    <div class="navbar-header">
                        <button type="button" class="offcanvas-toggle pull-right" data-toggle="offcanvas"
                                data-target="#js-bootstrap-offcanvas" aria-expanded="false">
                            <span class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <!-- Logo -->
					    <?php if ($logoposition == 'menu') :?>
						    <?php echo $logo; ?>
					    <?php endif; ?>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="navbar-main-menu navbar-<?php echo $menualign; ?>">
                        <jdoc:include type="modules" name="navbar" style="notitle"/>
                    </div>

                    <!-- Mobile Navigation Collapse -->
                    <div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
                        <div class="navbar-mobile">
                            <jdoc:include type="modules" name="navbar" style="notitle"/>
                        </div>
                    </div>
                </div>
            </nav>
	    <?php endif; ?>
    </div>
	<?php endif; ?>
    <!-- End Navigation bar -->


    <div class="componentbar">
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
    <footer class="footerbar" role="contentinfo">
        <div class="footerblocks">
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
        <div class="footer_totop">
            <div class="<?php echo $footermodule; ?>">
                <jdoc:include type="modules" name="footer" style="xhtml"/>
            </div>
			<?php if ($this->params->get('totop') == 1): ?>
                <div class="<?php echo $totopicon; ?>">
                    <a href="#">
					<span class="totop">
  						<i class="fa fa-angle-up fa-3x" aria-hidden="true"></i>
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
