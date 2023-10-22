<?php

namespace GHSVS\Module\ToastGhsvs\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

class ToastGhsvsHelper
{
	public function getDisplayData(Array $data): array
	{
		$moduleParams = $data['params'];
		$toastClass = trim($moduleParams->get('toastClass', ''));
		$forcePosition = $moduleParams->get('forcePosition', 'position-relative');

		// Stunden, hours
		$hideInterval = (int) $moduleParams->get('hideInterval', 0);
		$module = $data['module'];

		if (($content = $module->content) && $moduleParams->get('prepare_content', 0))
		{
			PluginHelper::importPlugin('content');
			$content = HTMLHelper::_('content.prepare', $content, null, 'mod_custom.content');
		}

		return [
			'toastId' => 'toastGhsvs' . $module->id,
			'forcePosition' => $forcePosition ? ' ' . $forcePosition : '',
			'hideInterval' => $hideInterval,
			// 14 stunden 60 * 60 * 14
			'cookieTimeSeconds' => 60 * 60 * $hideInterval,
			'headline' => Text::_($moduleParams->get('headline', '')),
			'toastClass' => $toastClass ? ' ' . $toastClass : '',
			'content' => $content,
			'robotsHide' => $moduleParams->get('robotsHide', 1) === 1
				&& $data['app']->client->robot === true,
			'moduleclass_sfx' => htmlspecialchars($moduleParams->get('moduleclass_sfx', ''),
				ENT_COMPAT, 'UTF-8'),
			'wam' => Factory::getDocument()->getWebAssetManager(),
		];
	}
}
