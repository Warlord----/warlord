<?php
namespace Warlord\Assetic\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Assetic\Filter\JpegoptimFilter;

class JpegOptimFactory implements \Zend\ServiceManager\FactoryInterface
{
	
	public function createService(ServiceLocatorInterface $sm) {
		$config = $sm->get('config');
		if(!$config['asset_manager']['debug'])
		{
			$filter = new JpegoptimFilter(ROOT_PATH . '/jpegoptim64.exe');
			$filter->setMax(90);
			return $filter; 
		}
		else return new NoFilter();
	}
}

?>