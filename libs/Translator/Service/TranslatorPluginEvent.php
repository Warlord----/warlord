<?php 
namespace Warlord\Translator\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\Session\Container;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\Mvc\MvcEvent;
use Zend\Http\PhpEnvironment\Request;
use Zend\Stdlib\Parameters;

class TranslatorPluginEvent implements EventManagerAwareInterface
{ 
	/**
	 * @var EventManager
	 */
	protected $events;
	
	public function setEventManager(EventManagerInterface $eventManager)
	{
		$eventManager->setIdentifiers(array(
			__CLASS__,
			get_called_class(),
		));
		$this->events = $eventManager;
		$this->events->getSharedManager()->attach('Zend\Mvc\Application', 'dispatch', array($this, 'dispatch'), 5);
		return $this;
	}
	
	public function getEventManager()
	{
		if (null === $this->events) {
			$this->setEventManager(new EventManager());
		}
		return $this->events;
	}
	
	public function dispatch(MvcEvent $event)
	{
		$sm = $event->getApplication()->getServiceManager();
		$request = $sm->get('request');
		$config = $sm->get('config');
		
		$translator = $sm->get('MvcTranslator');
// 		$currLocale = $translator->getLocale();
		
		$session = new Container('locale');
		$session->setExpirationSeconds('31104000');
		
		$lang = $request->getPost()->lang;
		if($lang)
		{
			$langLocale = $lang;
			$request->setPost(new Parameters());
			$request->setMethod('GET');
		}
		elseif(getenv("APPLICATION_ENV") == 'testing')
		  $langLocale = 'en_US';
		elseif(isset($session->lang))
			$langLocale = $session->lang;
		else
			try {
			$langLocale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			} catch(\Exception $e) {
				$langLocale = $translator->getLocale();
			}
		
		$translator->setLocale($langLocale);
		$sm->setAllowOverride(true);
		$sm->setService('translator', $translator);
		$session->lang = $langLocale;
	}
	
}
?>
