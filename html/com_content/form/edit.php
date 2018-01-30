<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 0));
JHtml::_('formbehavior.chosen', 'select');
$this->tab_name = 'com-content-form';
$this->ignore_fieldsets = array('image-intro', 'image-full', 'jmetadata', 'item_associations');

// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);

if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			" . $this->form->getField('articletext')->save() . "
			Joomla.submitform(task);
		}
	}
");
?>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
		<fieldset>
			<div class="row-fluid">
				<!-- Left column -->
				<div class="col-md-8">
			<?php echo JHtml::_('bootstrap.startTabSet', $this->tab_name, array('active' => 'editor')); ?>

			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'editor', JText::_('COM_CONTENT_ARTICLE_CONTENT')); ?>
				<?php echo $this->form->renderField('title'); ?>

				<?php if (is_null($this->item->id)) : ?>
					<?php echo $this->form->renderField('alias'); ?>
				<?php endif; ?>

				<?php echo $this->form->getInput('articletext'); ?>

				<?php if ($this->captchaEnabled) : ?>
					<?php echo $this->form->renderField('captcha'); ?>
				<?php endif; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

			<?php if ($params->get('show_publishing_options', 1) == 1) : ?>	
				<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'metadata', JText::_('COM_CONTENT_METADATA')); ?>
					<?php echo $this->form->renderField('metadesc'); ?>
					<?php echo $this->form->renderField('metakey'); ?>
				<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>

			<?php if ($params->get('show_urls_images_frontend')) : ?>
			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'images', JText::_('COM_CONTENT_IMAGES_AND_URLS')); ?>
				<?php echo $this->form->renderField('image_intro', 'images'); ?>
				<?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
				<?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
				<?php echo $this->form->renderField('image_fulltext', 'images'); ?>
				<?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
				<?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>


			<?php echo JHtml::_('bootstrap.endTabSet'); ?>

			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
			<?php echo JHtml::_('form.token'); ?>
			</div>

			<!-- Right column -->
				<div class="col-md-4">
					<div class="well">
						<h3><?php echo JText::_('DETAILS') ?></h3>
						<?php echo $this->form->renderField('state'); ?>
						<?php echo $this->form->renderField('catid'); ?>
						<?php echo $this->form->renderField('access'); ?>
						<?php echo $this->form->renderField('language'); ?>
						<?php echo $this->form->renderField('featured'); ?>
						<?php echo $this->form->renderField('publish_up'); ?>
						<?php echo $this->form->renderField('publish_down'); ?>
					
					<div class="btn-toolbar">
							<div class="btn-group">
								<button type="button" class="btn" onclick="Joomla.submitbutton('article.cancel')">
									<span class="fas fa-times"></span>&#160;<?php echo JText::_('JCANCEL') ?>
								</button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-success" onclick="Joomla.submitbutton('article.save')">
									<span class="fas fa-check"></span>&#160;<?php echo JText::_('JSAVE') ?>
								</button>
							</div>
						</div>
					</div>
				</div><!-- Right column -->

		</div>
		</fieldset>
	</form>
</div>
