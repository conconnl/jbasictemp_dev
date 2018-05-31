<?php
/*
 * @package     Basic template
 * @copyright   Copyright (c) Joomla Community Netherlands
 * @license     GNU General Public License version 3 or later
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

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
<?php BasicTemplateHelper::getAnalytics(); ?>
<div class="<?php echo $containerstyle; ?>">
	<?php if ($logoposition == 'header') :?>
    <div class="headerbar">
		    <?php echo $logo; ?>
    </div>
	<?php endif; ?>

	<?php if (($this->countModules('toolbar-l')) | ($this->countModules('toolbar-r'))) : ?>
        <!-- Toolbar -->
        <div class="toolbar <?php echo $toolbarcolor. " " .$toolbarphone; ?>">
            <div class="<?php echo $toolbarcontainerstyle; ?>">
                <div class="toolbar-l">
                    <jdoc:include type="modules" name="toolbar-l" style="notitle" />
                </div>
                <div class="toolbar-r">
                    <jdoc:include type="modules" name="toolbar-r" style="notitle" />
                </div>
            </div>
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

    <main class="main">

		<?php if ($this->countModules('slideshow')): ?>
            <!-- Slideshow -->
            <div id="slideshow" class="slideshow text-center <?php echo $slideshowcolor. " " .$slideshowpadding. " " .$slideshowphone; ?> clearfix">
                <div class="<?php echo $slideshowwidth; ?>">
                    <jdoc:include type="modules" name="slideshow" style="notitle" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('breadcrumbs')): ?>
            <!-- Breadcrumbs -->
            <div id="breadcrumbs" class="breadcrumbs <?php echo $breadcrumbscolor. " " .$breadcrumbspadding. " " .$breadcrumbsphone; ?>clearfix">
                <div class="<?php echo $breadcrumbswidth; ?>">
                    <jdoc:include type="modules" name="breadcrumbs" style="notitle"/>
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('top-a')): ?>
            <!-- Top-A -->
            <div id="top-a" class="top-a <?php echo $topacolor. " " .$topapadding. " " .$topaphone; ?> clearfix">
                <div class="<?php echo $topawidth; ?>">
                    <jdoc:include type="modules" name="top-a" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('top-b')): ?>
            <!-- Top-B -->
            <div id="top-b" class="top-b <?php echo $topbcolor. " " .$topbpadding. " " .$topbphone; ?> clearfix">
                <div class="<?php echo $topbwidth; ?>">
                    <jdoc:include type="modules" name="top-b" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('top-c')): ?>
            <!-- Top-C -->
            <div id="top-c" class="top-c <?php echo $topccolor. " " .$topcpadding. " " .$topcphone; ?> clearfix">
                <div class="<?php echo $topcwidth; ?>">
                    <jdoc:include type="modules" name="top-c" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('top-d')): ?>
            <!-- Top-D -->
            <div id="top-d" class="top-d <?php echo $topdcolor. " " .$topdpadding. " " .$topdphone; ?> clearfix">
                <div class="<?php echo $topdwidth; ?>">
                    <jdoc:include type="modules" name="top-d" style="equal" />
                </div>
            </div>
		<?php endif; ?>

        <div id="mainbody" class="mainbody <?php echo $mainbodycolor. " " .$mainbodypadding; ?> clearfix">
            <div class="<?php echo $mainbodywidth; ?>">
                <div class="row">

					<?php if ($this->countModules('left')): ?>
                        <!-- Sidebar Left -->
                        <div id="left" class="sidebar-left col-md-<?php echo $leftwidth; ?>">
                            <jdoc:include type="modules" name="left" style="standard" />
                        </div>
					<?php endif; ?>

                    <!-- Content block -->
                    <div id="content" class="col-md-<?php echo $componentwidth;?>">
                        <div id="message-component">
                            <jdoc:include type="message" />
                        </div>

						<?php if ($this->countModules('content-top')): ?>
                            <!-- Content Top -->
                            <div id="content-top">
                                <jdoc:include type="modules" name="content-top" style="equal" />
                            </div>
						<?php endif; ?>

						<?php
						$app = Factory::getApplication();
						$menu = $app->getMenu();
						$lang = Factory::getLanguage();

						if ($homepagecomponent){ // show on all pages ?>
                            <div id="content-area">
                                <jdoc:include type="component" />
                            </div>
						<?php } else {
							if ($menu->getActive() !== $menu->getDefault($lang->getTag())) { // show on all pages but not the homepage ?>
                                <div id="content-area">
                                    <jdoc:include type="component" />
                                </div>
								<?php
							}
						}
						?>

						<?php if ($this->countModules('content-bottom')): ?>
                            <!-- Content Bottom -->
                            <div id="content-bottom">
                                <jdoc:include type="modules" name="content-bottom" style="equal" />
                            </div>
						<?php endif; ?>

                    </div>

					<?php if ($this->countModules('right')): ?>
                        <!-- Sidebar Right -->
                        <div id="right" class="sidebar-right col-md-<?php echo $rightwidth; ?>">
                            <jdoc:include type="modules" name="right" style="standard" />
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>

		<?php if ($this->countModules('bottom-a')): ?>
            <!-- Bottom-A -->
            <div id="bottom-a" class="bottom-a <?php echo $bottomacolor. " " .$bottomapadding. " " .$bottomaphone; ?> clearfix">
                <div class="<?php echo $bottomawidth; ?>">
                    <jdoc:include type="modules" name="bottom-a" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('bottom-b')): ?>
            <!-- Bottom-B -->
            <div id="bottom-b" class="bottom-b <?php echo $bottombcolor. " " .$bottombpadding. " " .$bottombphone; ?> clearfix">
                <div class="<?php echo $bottombwidth; ?>">
                    <jdoc:include type="modules" name="bottom-b" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('bottom-c')): ?>
            <!-- Bottom-C -->
            <div id="bottom-c" class="bottom-c <?php echo $bottomccolor. " " .$bottomcpadding. " " .$bottomcphone; ?> clearfix">
                <div class="<?php echo $bottomcwidth; ?>">
                    <jdoc:include type="modules" name="bottom-c" style="equal" />
                </div>
            </div>
		<?php endif; ?>

		<?php if ($this->countModules('bottom-d')): ?>
            <!-- Bottom-D -->
            <div id="bottom-d" class="bottom-d <?php echo $bottomdcolor. " " .$bottomdpadding. " " .$bottomdphone; ?> clearfix">
                <div class="<?php echo $bottomdwidth; ?>">
                    <jdoc:include type="modules" name="bottom-d" style="equal" />
                </div>
            </div>
		<?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>

		<?php if ($this->countModules('footer-menu')): ?>
            <!-- Footer Menu -->
            <div id="footer-menu" class="footer-menu <?php echo $footermenucolor. " " .$footermenupadding. " " .$footermenuphone; ?> clearfix">
                <div class="<?php echo $footermenuwidth; ?>">
                    <jdoc:include type="modules" name="footer-menu" style="equal" />
                </div>
            </div>
		<?php endif; ?>

        <!-- Copyright -->
        <div id="copyright" class="copyright <?php echo $copyrightcolor. " " .$copyrightpadding; ?> clearfix">
            <div class="<?php echo $copyrightwidth; ?> text-<?php echo $copyrightalign; ?>">
                <jdoc:include type="modules" name="copyright" style="notitle" />
                <jdoc:include type="modules" name="cookies" style="notitle" />
            </div>
        </div>
    </footer>

    <jdoc:include type="modules" name="debug" style="notitle"/>

    <?php if ($backtotopshow){ ?>
        <!-- Back to Top Button -->
        <a id="back-to-top" href="#" class="back-to-top btn btn-primary btn-sm" role="button"><i class="fa fa-angle-up fa-3x"></i></a>

        <script>
            // Javascript for Scroll to Top function
            $(document).ready(function(){
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 300) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

            });
        </script>

	<?php } ?>
</div>
</body>
</html>
