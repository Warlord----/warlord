<?php
namespace Warlord\Assetic\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class UriPrependFactory extends \Assetic\Filter\UriPrependFilter implements \Zend\ServiceManager\FactoryInterface
{
	
	public function createService(ServiceLocatorInterface $sm) {
		$config = $sm->get('config');
		$this->path = $config['baseURL'];
		return $this;
	}
}

?>