<?php
namespace Warlord\Bjy\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;


class NavigationFactory implements  FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $sm)
    {
    	try{
	        $auth = $sm->getServiceLocator()->get('BjyAuthorize\Service\Authorize');
			$role = $auth->getIdentityProvider()->getIdentityRoles();
			if(is_array($role))
			{
			    if(count($role) > 0)
				    $role = $role[0];
			    else $auth = null;
			}
    	}
    	catch (\Exception $e){$auth = null;}
    	
		$navigation = $sm->get('Zend\View\Helper\Navigation');
		if($auth)
		{
			$navigation->setAcl($auth->getAcl())
			->setRole($role);
		}
		
		$navigation->setTranslator($sm->getServiceLocator()->get('translator'));
		
		return $navigation;
    }
}
