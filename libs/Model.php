<?php

namespace Warlord;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class Model extends \ActiveRecord\Model implements InputFilterAwareInterface {

	protected $inputFilter;
	
    public function setInputFilter(InputFilterInterface $inputFilter) {  }

    public function getInputFilter()
    { 
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    		
	    	if(isset(static::$validates_size_of))
	    	{
	    		foreach (static::$validates_size_of as $validate)
	    		{
		    		$inputFilter->add($factory->createInput(array(
		    				'name'     => $validate[0],
		    				'required' => false,
		    				'validators' => array(
		    						array(
		    								'name'    => 'StringLength',
		    								'options' => array(
		    										'encoding' => 'UTF-8',
		    										'min'      => isset($validate['within']) ? $validate['within'][0] : (isset($validate['minimum']) ? $validate['minimum'] : 0),
		    										'max'      => isset($validate['within']) ? $validate['within'][1] : (isset($validate['maximum']) ? $validate['maximum'] : PHP_INT_MAX),
		    								),
		    						),
		    				),
		    		)));
	    		}
	    	}
	    	if(isset(static::$validates_presence_of))
	    	{
	    		foreach (static::$validates_presence_of as $validate)
	    		{
		    		$inputFilter->add($factory->createInput(array(
		    				'name'     => $validate[0],
		    				'required' => true,
		    		)));
	    		}
	    	}
	    	if(isset(static::$validates_numericality_of))
	    	{
	    		foreach (static::$validates_numericality_of as $validate)
	    		{
		    		$inputFilter->add($factory->createInput(array(
		    				'name'     => $validate[0],
		    				'validators' => array(
		    						array(
		    								'name'    => isset($validate['only_integer']) ? 'Int' : '',
		    						),
		    				),
		    		)));
	    		}
	    	}
	    	if(isset(static::$validates_uniqueness_of))
	    	{
	    		foreach (static::$validates_uniqueness_of as $validate)
	    		{
		    		$inputFilter->add($factory->createInput(array(
		    				'name'     => $validate[0],
		    				'validators' => array(
		    				    array(
		    						'name' => 'Db\NoRecordExists',
                                    'options' => array(
                                        'table' => $this->table_name(),
                                        'field' => $validate[0],
                                        'adapter' => \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter(),
                                      ),
		    				       ),
		    				),
		    		)));
	    		}
	    	}
    	}
    	return $inputFilter;
    }
    
    public function getArrayCopy(){
        return $this->attributes();
    }
    
    public function is_valid()
    {
        try{
            return parent::is_valid();
        }catch(\ActiveRecord\ValidationsArgumentError $e)
        {
            $this->errors->add('', $e->getMessage());
            return false;
        }
        
    }
    
    public function is_invalid()
    {
        return !$this->is_valid();
    }
    
    public function save($validate = true)
    {
        try{
            return parent::save($validate);
        }catch(\ActiveRecord\ValidationsArgumentError $e)
        {
            $this->errors->add('', $e->getMessage());
            return false;
        }
    }
}
