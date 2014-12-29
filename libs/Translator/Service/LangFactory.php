<?php
namespace Warlord\Translator\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Warlord\Translator\View\Helper\Lang;

class LangFactory extends AbstractPluginManagerFactory
{
	public function createService(ServiceLocatorInterface $pm) {
		$sm =  $pm->getServiceLocator();
		$config = $sm->get('config');
		/* @var $translator Zend\I18n\Translator */
		$translator = $sm->get('translator');
		$lang = new Lang();
		$lang->setLocale($translator->getLocale());
		return $lang;
	}
}