<?php

namespace GHSVS\Module\ToastGhsvs\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
	use HelperFactoryAwareTrait;

	protected function getLayoutData()
	{
		/*
		$module
		$params
		$app
		$input
		$template
		*/
		$data = parent::getLayoutData();
		$helper = $this->getHelperFactory()->getHelper('ToastGhsvsHelper');
		$displayData = $helper->getDisplayData($data);
		return array_merge($data, $displayData);
	}
}
