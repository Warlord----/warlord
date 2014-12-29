<?php
namespace Warlord\Bjy\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Application\View\Helper\DbProfiler;


class DbProfilerFactory implements  FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
		$helper = new DbProfiler();
		$helper->setProfiler(
				$sm->get('Zend\Db\Adapter\Adapter')
					->getProfiler());
		return $helper;
    }
}
