<?php

namespace SalesObjects\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PortsForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('cabins');
		
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
                
                $this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'cruiseId',
				'options' => array(
						'label'          => 'Cruise',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Base\Entity\Avp\Cruises',
						'property'       => 'title',
						'empty_option'   => 'please select cruise...',
                                                'find_method'    => array(
							                'name'   => 'findBy',
							                'params' => array(
							                    'criteria' => array('isDeleted' => 0,'status'=>1),
							
							                ),
							            ),
				),
		));
		
		$this->add(array(
				'name' => 'title',
				'attributes' => array(
						'type'  => 'text',
						'required' => 'required',						
				),
				'options' => array(
						'label' => 'Title',
				),
		));		
		
						
		$this->add(array(
				'name' => 'description',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Description',
				),
		));
		
		$this->add(array(
				'name' => 'thingsToDo',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Things To Do',
				),
		));
		
		$this->add(array(
				'name' => 'dontMiss',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => "Don't Miss",
				),
		));
		
                $this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Submit',
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
