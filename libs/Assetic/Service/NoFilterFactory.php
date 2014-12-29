<?php
namespace Warlord\Assetic\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Assetic\Filter\FilterInterface;
use Assetic\Asset\AssetInterface;

class NoFilterFactory extends \Assetic\Filter\UriPrependFilter implements \Zend\ServiceManager\FactoryInterface
{
	
	public function createService(ServiceLocatorInterface $sm) {
		return new NoFilter();
	}
}


