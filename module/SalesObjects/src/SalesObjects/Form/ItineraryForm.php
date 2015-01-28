<?php

namespace SalesObjects\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ItineraryForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('iterary');
		
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
		
		$this->add(array(
				'name' => 'day',
				'attributes' => array(
						'type'  => 'number',
						'required' => 'required',
						'min'	   => 1,
						'max'	   => 8,
						'placeholder' => 'min 1, max 8',						
				),
				'options' => array(
						'label' => 'Day',
				),
		));		
		
						
		$this->add(array(
				'name' => 'portLocation',
				'attributes' => array(
						'type'  => 'text',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Port Location',
				),
		));
		
		$this->add(array(
				'name' => 'arrivalTime',
				'attributes' => array(
						'type'  => 'time',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Arrival Time',
				),
		));
		
		$this->add(array(
				'name' => 'departureTime',
				'attributes' => array(
						'type'  => 'time',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Departure Time',
				),
		));
		
		$this->add(array(
				'name' => 'activity',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Activity',
				),
		));
			
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
		        'name'    => 'cruise',
		        'attributes' => array(
							'required' => 'required',
				),
		        'options' => array(
		            'label'          => 'Cruise',
		            'object_manager' => $this->getObjectManager(),
		            'target_class'   => 'Base\Entity\Cruises',
		            'property'       => 'name',
		            'empty_option'   => '--- please choose ---'
		        ),
		));		
		
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Ok',
						'id' => 'submitbutton',
				),
		));
		
		
		
		$hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
		$this->setHydrator($hydrator);
		$this->bind($this->getTargetEntity());
		
	}
	
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	
		return $this;
	}
	
	public function getObjectManager()
	{
		return $this->objectManager;
	}
	
	protected function getTargetEntity(){
		
		return $this->targetEntity;
		
	}
	
	protected function setTargetEntity($targetEntity){
		
		if(!is_object($targetEntity)){
			
			$this->targetEntity = new $targetEntity();
			
		} else {
			
			$this->targetEntity = $targetEntity;
			
		}			
	}
		
}
