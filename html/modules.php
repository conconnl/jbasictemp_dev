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
?>
