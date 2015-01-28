<?php

namespace SalesObjects\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class CabinsForm extends Form implements ObjectManagerAwareInterface{
	
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
				'type' => 'Zend\Form\Element\Select',                                
				'name' => 'deckNumber',
				'options' => array(
						'label' => 'Deck Number',
						'value_options' => $this->getArray(),
				)
		));
                
                $this->add(array(
				'name' => 'deckName',
				'attributes' => array(
						'type'  => 'text',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Suite Name',
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
		 		'name' => 'deckImageUrl',
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
        
        protected function getArray($num = 20){
            $arr = array();
            for($i=1;$i<$num +1;$i++){
                $arr[$i]=$i;
            }
            return $arr;
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
