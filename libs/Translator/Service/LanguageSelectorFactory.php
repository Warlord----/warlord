<?php
namespace Warlord\Translator\Service;

use Application\View\Helper\LanguageSelector;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Service\AbstractPluginManagerFactory;

class LanguageSelectorFactory extends AbstractPluginManagerFactory
{
	public function createService(ServiceLocatorInterface $pm) {
		$sm =  $pm->getServiceLocator();
		$config = $sm->get('config');
		/* @var $translator Zend\I18n\Translator */
		$translator = $sm->get('translator');
		$ls = new LanguageSelector();
		$ls->setLocale($translator->getLocale());
		$ls->setRequest($sm->get('request'));
		return $ls;
	}
}