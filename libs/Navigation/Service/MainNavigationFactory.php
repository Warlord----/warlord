<?php
namespace Warlord\Navigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;
use Application\Model\Article;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Main navigation factory.
 */
class MainNavigationFactory extends AbstractNavigationFactory
{
	/**
	 * @return string
	 */
	protected function getName()
	{
		return 'main';
	}
	
	
}