<?php

namespace Marketing\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddPdfForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('sales');
		
		$this->setAttribute('method', 'post');
                
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
               
		$this->add(array(
				'name' => 'name',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Name',
				),
		));
                
                
                $this->add(array(
				'type'    => 'Zend\Form\Element\Select',
				'name'    => 'for_type',
				'options' => array(
						'label'          => 'For',
						'empty_option'   => 'please select...',
                                                'value_options'        => array(
                                                    '1'=>'Resorts',
                                                    '2'=>'Events',
                                                    '3'=>'Cruises',
                                                    '4'=>'Items',
                                                    '5'=>'Excursions',
                                                    '6'=>'Transfer',
                                                )    
				),
                                'attributes' => array(				
                                                'required' => 'required',
                                                'id' => 'myselect',
				),
                                
		));
                
               
                $this->add(array(
		 		'name' => 'pdf',
		 		'attributes' => array(
		 				'type'  => 'file',
		 				'accept' => 'pdf/*',
		 		),
		 		'options' => array(
		 				'label' => 'Pdf',
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
