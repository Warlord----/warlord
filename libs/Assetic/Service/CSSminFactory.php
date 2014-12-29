<?php
namespace Warlord\Assetic\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class CSSminFactory implements \Zend\ServiceManager\FactoryInterface
{
	
	public function createService(ServiceLocatorInterface $sm) {
		$config = $sm->get('config');
		if(!$config['asset_manager']['debug'])
			return new \Assetic\Filter\CSSminFilter();
		else return new NoFilter();
	}
}

?>