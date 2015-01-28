<?php

namespace Users\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddUserForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('user');
		
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
		$this->add(array(
				'name' => 'login',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Login',
				),
		));
		$this->add(array(
				'name' => 'password',
				'attributes' => array(
						'type'  => 'password',
				),
				'options' => array(
						'label' => 'Password',
				),
		));
		
		$this->add(array(
				'name' => 'repassword',
				'attributes' => array(
						'type'  => 'password',
				),
				'options' => array(
						'label' => 'Confirm Password',
				),
		));
		
		$this->add(array(
				'name' => 'email',
				'attributes' => array(
						'type'  => 'email',
				),
				'options' => array(
						'label' => 'Email',
				),
		));
		
		$this->add(array(
				'name' => 'firstName',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'First Name',
				),
		));
		
		$this->add(array(
				'name' => 'lastName',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Last Name',
				),
		));
		
		$this->add(array(
				'name' => 'phone',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Phone',
				),
		));
		
		$this->add(array(
				'name' => 'address',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Address',
				),
		));
		
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
		        'name'    => 'role',
		        'options' => array(
		            'label'          => 'Role',
		            'object_manager' => $this->getObjectManager(),
		            'target_class'   => 'Base\Entity\Role',
		            'property'       => 'name',
		            'empty_option'   => 'please select role...'
		        ),
		         		'attributes' => array(				
                                                'required' => 'required',
				),
		));
                
       
        
         $this->add(array(
            'name' => 'city',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'City',
            ),
        ));
         
         $this->add(array(
            'name' => 'state',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'State/Province',
            ),
        ));
        
         $this->add(array(
            'name' => 'zip',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Zip',
            ),
        ));
         
            $this->add(array(
            'name' => 'suite',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Suite',
            ),
        ));
         
            
            
            
            
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'country',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Countries',
                'property' => 'countryName',
                'empty_option' => 'please select country...'
            ),
        ));
         
                
                
           $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'accountType',
            'options' => array(
                'label' => 'Payment Type',
                'value_options' => array(
                    '1' => 'Commision',
                    '0' => 'Salary',
                    '2' => 'Both'
                ),
            ),
            'attributes' => array(
                'value' => '0' 
            ),
        ));
         
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'paySchedule',
            'options' => array(
                'label' => 'Payment Schedule',
                'value_options' => array(
                    '0' => 'Weekly',
                    '1' => 'Bi-Weekly',
                    '2'=>  'Monthly'
                ),
            ),
            'attributes' => array(
                'value' => '0' 
            ),
        ));
           
   
         
         
         $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'payroll',
            'options' => array(
                'label' => 'Add to payroll',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Yes'
                ),
            ),
            'attributes' => array(
                'value' => '0' 
            ),
        ));
         
        
         
        $this->add(array(
            'name' => 'rate',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
                //'required' => 'required',
                'id' => 'rate'
            ),
            'options' => array(
                'label' => 'Rate',
            ),
        ));
        
         $this->add(array(
            'name' => 'startingFrom',
            'attributes' => array(
                'type' => 'date',
               // 'required' => 'required',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Starting From',
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