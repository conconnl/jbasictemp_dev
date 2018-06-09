<?php
defined('_JEXEC') or die;

// No title
function modChrome_notitle($module, &$params, &$attribs)
{
	$module_tag      	= htmlspecialchars($params->get('module_tag', 'div'), ENT_COMPAT, 'UTF-8'); 
	$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
	$bootstrap_size		= $params->get('bootstrap_size');

	if ($module->content) {
		if ($bootstrap_size) {
				echo '<div class="col-md-' . $bootstrap_size . '">';
			}?>
			<<?php echo $module_tag; ?> class="module">

			<div class="module-content">
			<?php echo $module->content; ?>
			</div>

			</<?php echo $module_tag; ?>>
		<?php } ?>

	<?php if ($bootstrap_size) {
		echo '</div>';
	}
}
// Standard
function modChrome_standard($module, &$params, &$attribs)
{
	$header_tag      	= htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
	$header_class      	= htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
	$module_tag      	= htmlspecialchars($params->get('module_tag', 'div'), ENT_COMPAT, 'UTF-8'); 
	$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
	$bootstrap_size		= $params->get('bootstrap_size');

	if ($module->content) {
		if ($bootstrap_size) {
				echo '<div class="col-md-' . $bootstrap_size . '">';
			}?>
			<<?php echo $module_tag; ?> class="module <?php echo $moduleclass_sfx; ?>">

			<?php if ((bool) $module->showtitle) { ?>
			<div class="module-title <?php echo $header_class; ?>">
				<<?php echo $header_tag; ?>><?php echo $module->title; ?></<?php echo $header_tag; ?>>
			</div>
			<?php } ?>

			<div class="module-content">
			<?php echo $module->content; ?>
			</div>

			</<?php echo $module_tag; ?>>
		<?php } ?>

	<?php if ($bootstrap_size) {
		echo '</div>';
	}
}

// Equal divided
function modChrome_equal($module, $params, $attribs)
{
	static $modulescount;
	global $modules;

	$header_tag      	= htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
	$header_class      	= htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
	$module_tag      	= htmlspecialchars($params->get('module_tag', 'div'), ENT_COMPAT, 'UTF-8'); 
	$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

	$modulescount = count(JModuleHelper::getModules($attribs['name']));
	$name='';
	
	if (isset($attribs['name'])){
		$name = $attribs['name'];
		if (isset($modules[$name])){
			$modules[$name] += 1;
		} else {
			$modules[$name] = 1;
		}
	}

	if ($module->content) {
		$modules[$name] == 1;
		$counter = ($modules[$name]);
		
		$modspan = ($modulescount %4);	
		if ($modspan != 0) {
			if ($modspan == 1) {
				$modspan = 'col-xs-12';
			} elseif ($modspan == 2) {
				$modspan = 'col-sm-6 col-xs-12';
			} elseif ($modspan == 3) {
				$modspan = 'col-sm-4 col-xs-12';
			}
		} else {
			$modspan = 'col-md-3 col-sm-6 col-xs-12';
		}
		
		$rest = ($modulescount %4);
		if ($rest == 1) {
			$rest = 1;
		} elseif  ($rest == 2) {
			$rest = 2;
		} elseif  ($rest == 3) {
			$rest = 3;
		} else {
			$rest = 4;
		}
		
		if ($counter%4 == 1) {
			echo '<div class="row equal">';
		}
		if (($counter - 1) >= ($modulescount - $rest)) {
			echo '<div class="'. $modspan .'">';
		} else {
			echo '<div class="col-md-3">';
		}

		echo '<'. $module_tag .' class="module '. $moduleclass_sfx .'">';
		
		if ($module->content) {
			if ((bool) $module->showtitle) {
				echo '<div class="module-title <?php echo $header_class; ?>">';
				echo '<'. $header_tag .' class="'. $header_class .'">'. $module->title .'</'. $header_tag .'>';
				echo '</div>';
			}
			echo '<div class="module-content">';
			echo $module->content;
			echo '</div>';
		}
		echo '</'. $module_tag .'>';
	echo '</div>';
	
		if (($counter%4 == 0) && ($counter != $modulescount)) {
			echo '</div>';
		}
			
		if ($counter == $modulescount) {
			echo '</div>';
		}
	}
}

?>