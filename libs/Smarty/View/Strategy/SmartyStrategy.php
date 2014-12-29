<?php
namespace Warlord\Smarty\View\Strategy;

use Zend\View\Resolver\ResolverInterface;
class SmartyStrategy extends \SmartyModule\View\Strategy\SmartyStrategy
{
//     protected $map;
    
    /**
     * 
     * @var ResolverInterface $resolver
     */
    protected $resolver;
     
    public function selectRenderer(\Zend\View\ViewEvent $e)
    {
        if($this->checkIfTpl($e))
            return parent::selectRenderer($e);

    }
    
//     public function setMap($map)
//     {
//         $this->map = $map;
//     }
    
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }
    
    protected function checkIfTpl(\Zend\View\ViewEvent $e)
    {
//         $map = $this->map->getMap();
//         $path = $map[$e->getModel()->getTemplate()];
        $path = $this->resolver->resolve($e->getModel()->getTemplate());
        if(!$path)
            return true; // assume dynamic pages have tpl
        
        return substr($path, count($path) - 4) == 'tpl';
    }
}