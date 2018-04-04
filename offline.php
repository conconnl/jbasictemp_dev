<?php
/**
 * @package     Basic template
 * @copyright   Copyright (c) Joomla Community Netherlands
 * @license     GNU General Public License version 3 or later
 * @version     1.0
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

// variables
$app = Factory::getApplication();
$config = Factory::getConfig();
$template = $app->getTemplate();

// load sheets and scripts
JHtml::_('stylesheet', 'templates/' . $template . '/css/offline.css', array('version' => 'auto'));
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="head"/>
</head>

<body>
<jdoc:include type="message" />
<div id="frame" class="outline">
	<?php if ($config->get('offline_image')) : ?>
        <img src="<?php echo $config->get('offline_image'); ?>" alt="<?php echo $config->get('sitename'); ?>" />
	<?php endif; ?>
    <h1>
		<?php echo htmlspecialchars($config->get('sitename')); ?>
    </h1>
	<?php if ($config->get('display_offline_message', 1) == 1 && str_replace(' ', '', $config->get('offline_message')) != ''): ?>
        <p><?php echo $config->get('offline_message'); ?></p>
	<?php elseif ($config->get('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
        <p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
	<?php endif; ?>
    <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" id="form-login">
        <fieldset class="input">
            <p id="form-login-username">
                <label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label><br />
                <input type="text" name="username" id="username" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="18" />
            </p>
            <p id="form-login-password">
                <label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label><br />
                <input type="password" name="password" id="password" class="inputbox" alt="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="18" />
            </p>
            <p id="form-login-remember">
                <label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?></label>
                <input type="checkbox" name="remember" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?>" id="remember" />
            </p>
            <p id="form-login-submit">
                <label>&nbsp;</label>
                <input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN'); ?>" />
            </p>
        </fieldset>
        <input type="hidden" name="option" value="com_users" />
        <input type="hidden" name="task" value="user.login" />
        <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()); ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
    </form>
</div>
</body>

</html>