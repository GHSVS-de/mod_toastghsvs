<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;

if ($params->get('robotsHide', 1) === 1
	&& Factory::getApplication()->client->robot === true)
{
	return;
}

if ($params->get('prepare_content', 0))
{
	PluginHelper::importPlugin('content');
	$module->content = HTMLHelper::_('content.prepare', $module->content, '',
		'mod_custom.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT,
	'UTF-8');
require ModuleHelper::getLayoutPath('mod_toastghsvs', $params->get('layout',
	'default'));
