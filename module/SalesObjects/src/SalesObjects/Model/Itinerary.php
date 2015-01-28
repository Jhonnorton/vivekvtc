<?php
 
namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import


class Itinerary extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();
								
			$inputFilter->add($factory->createInput(array(
					'name'     => 'day',
					'required' => true,
					'filters'  => array(
                		array('name' => 'Int'),
            		),
					'validators' => array(
			              array(
			                  'name' => 'Between',
			                  'options' => array(
			                      'min' => 1,
			                      'max' => 8,
			                  ),
			              ),
			            ),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'portLocation',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 2,
											'max'      => 128,
												
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'arrivalTime',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'departureTime',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'activity',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 2,
												
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'cruise',
					'required' => true,
						
			)));															
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
} 
