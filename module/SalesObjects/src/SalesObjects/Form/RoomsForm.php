<?php

namespace SalesObjects\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class RoomsForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('rooms');
		
		$this->setAttribute('method', 'post');
		
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
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
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'resortId',
				'options' => array(
						'label'          => 'Resort',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Base\Entity\Avp\Resorts',
						'property'       => 'title',
						'empty_option'   => 'please select resort...',
                                                'find_method'    => array(
							                'name'   => 'findBy',
							                'params' => array(
							                    'criteria' => array('isDeleted' => 0,'status'=>1),
							
							                ),
							            ),
				),
                                'attributes' => array(				
                                                'required' => 'required',
				),
                                
		));
					
		$this->add(array(
		 		'name' => 'image',
		 		'attributes' => array(
		 				'type'  => 'file',
		 				'accept' => 'image/*',
		 		),
		 		'options' => array(
		 				'label' => 'Image',
		 		),
		 ));
                
                $this->add(array(
		 		'name' => 'price',
		 		'attributes' => array(
		 				'type'  => 'number',
                                                'required' => 'required',
		 				
		 		),
		 		'options' => array(
		 				'label' => 'Price',
		 		),
		));
                
                $this->add(array(
		 		'name' => 'inStock',
		 		'attributes' => array(
		 				'type'  => 'number',
                                                'required' => 'required',
		 				
		 		),
		 		'options' => array(
		 				'label' => 'In Stock',
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
