<?php defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES.'/'.$this->template.'/logic.php';

?>
<!doctype html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
	<!-- Le HTML5 shim and media query for IE8 support -->
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script type="text/javascript" src="<?php echo $tpath; ?>/js/respond.min.js"></script>
	<![endif]-->
</head>
  
<body class="<?php echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('site')).' '.$active->alias.' '.$pageclass; ?>" role="document">

	    <div class="container">
			<div class="row headerbar">
				<?php echo $logo; ?>
			</div>

			<!-- Begin Navbar -->
			<?php if ($this->countModules('navbar')) : ?>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div id="navbar" class="navbar-collapse collapse">
						<jdoc:include type="modules" name="navbar" />
					</div>
				</div>
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</nav>
			<?php endif; ?>
			<!-- End Navbar-->

		<div class="row">
			<!-- Begin Left Sidebar -->
			<?php if ($this->countModules('leftsidebar')) : ?>
				<div class="<?php echo $leftsidebar; ?>">
					<div class="leftsidebar">
						<jdoc:include type="modules" name="leftsidebar" style="xhtml" />
					</div>
				</div>
			<?php endif; ?>
			<!-- End Left Sidebar -->
	            <div class="<?php echo $componentarea; ?>">
					<jdoc:include type="message" />
	                <jdoc:include type="component" /> 
	            </div>

			<!-- Begin Right Sidebar -->
			<?php if ($this->countModules('rightsidebar')) : ?>
	            <div class="<?php echo $rightsidebar; ?>">
            		<div class="rightsidebar">
                    	<jdoc:include type="modules" name="rightsidebar" style="xhtml" />
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
				<jdoc:include type="modules" name="footerblock1" style="xhtml" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('footerblock2')) : ?>
			<div class="<?php echo $footerblock; ?>">
				<jdoc:include type="modules" name="footerblock2" style="xhtml" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('footerblock3')) : ?>
			<div class="<?php echo $footerblock; ?>">
				<jdoc:include type="modules" name="footerblock3" style="xhtml" />
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="<?php echo $footermodule; ?>">
			<jdoc:include type="modules" name="footer" style="xhtml" />
			</div>
			<?php if ($this->params->get('totop') == 1):?>
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
			<jdoc:include type="modules" name="debug" style="none" />
</div>
</body>
</html>