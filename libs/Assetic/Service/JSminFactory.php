<?php
namespace Warlord\Assetic\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class JSminFactory implements \Zend\ServiceManager\FactoryInterface
{
	
	public function createService(ServiceLocatorInterface $sm) {
		$config = $sm->get('config');
		if(!$config['asset_manager']['debug'])
			return new \Assetic\Filter\JSMinPlusFilter();
		else return new NoFilter();
	}
}

?>