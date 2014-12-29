<?php
namespace Warlord\Smarty\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Warlord\Smarty\View\Strategy\SmartyStrategy;


class SmartyStrategyFactory implements  FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $sm
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $sm)
    {
//         $map = $sm->get('ViewTemplateMapResolver');
        $resolver = $sm->get('viewresolver');
        $service = new SmartyStrategy($sm->get('SmartyRenderer'));
//         $service->setMap($map);
        $service->setResolver($resolver);
        
        return $service;
    }
}
