<?php
namespace Warlord\Translator\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Lang extends AbstractHelper
{
	private $locale;
	
	public function __invoke()
	{
    	return substr($this->locale, 0, 2);
	}
	
	public function setLocale($locale)
	{
		$this->locale = $locale;
	}
   
}
