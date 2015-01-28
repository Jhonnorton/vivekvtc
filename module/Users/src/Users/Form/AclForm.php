<?php

namespace Users\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AclForm extends Form implements ObjectManagerAwareInterface{
	
    public function __construct(ObjectManager $objectManager, $targetEntity, $id = null)
    {
        $this->setObjectManager($objectManager);
        
        //d($objectManager);
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
                        'name' => 'name',
                        'attributes' => array(
                                        'type'  => 'text',
                        ),
                        'options' => array(
                                        'label' => 'Role Name',
                        ),
        ));
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'isActive',
                        'options' => array(
                                        'label' => 'Status',
                                        'value_options' => array(
                                                    '1' => 'Enabled',
                                                    '0' => 'Disabled',
                                        ),
                        )
        ));

        $this->add(array(
                        'name' => 'resource',
                        'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                        'options' => array(
                                        'label' => 'Permissions',
                                        'object_manager' => $objectManager,
                                        'target_class'   => 'Base\Entity\Resource',
                                        'property'       => 'name',

                        ),
                        'attributes' => array(
                                'value' => $this->getPermissions($id),
                        )
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
        
        
     
        
      //   $this->addPaymentFields();
       // $this->add($addresses);


        $this->add(array(
                        'name' => 'submit',
                        'attributes' => array(
                                        'type'  => 'submit',
                                        'value' => 'Add',
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

    public function getObjectManager(){
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
    protected function getCheckedResources($id = null){
        $permissions = array();
        if(is_null($id))
                        return $permissions;

        $repository = $this->objectManager
                                           ->getRepository('Base\Entity\Permissions')
        ;

        $collection = $repository->findBy(array('role' => (int)$id, 'permission' => 1));

        foreach ($collection as $permission){

                $permissions[] = $permission->getResource()->getId();

        }
        //d($collection);
        return $permissions;
    }
    
    protected function getPermissions($id = null){               
        $permissions = array();
        if(is_null($id)) //d($permissions);return $permissions;
       
       /// echo "<pre>";        print_r($permissions);die;
        return $permissions;
            
        $repository = $this->objectManager->getRepository('Base\Entity\Permissions');
        $collection = $repository->findBy(array('role' => (int)$id));
        foreach($collection as $permission){
            $permissions[] = $permission->getResource()->getId();
            
        } 
      //  d('here in permisiion');
        return $permissions;
    }
    
    protected function getResources(){
        $resources = array();
        $repository = $this->objectManager->getRepository('Base\Entity\Resource');
        $collection = $repository->findAll();
        foreach($collection as $resource){
            $resources[$resource->getId()] = $resource->getName();
        }    
        d('here in form');
        return $resources;
    }
    
    
    
     protected function getModules(){
        $resources = array();
        $repository = $this->objectManager->getRepository('Base\Entity\Modules');
        $collection = $repository->findAll();
        foreach($collection as $resource){
            $resources[$resource->getId()] = $resource->getName();
        }    
        d('here in form');
        return $resources;
    }
    
    
    
    
     protected function addPaymentFields() {
      
        $contact = new Element\Text('contact');
        $contact->setLabel('Contact')
                ->setAttribute('class', 'form-control');
        $this->add($contact);

        $phones = new Element\Collection('phones');
        $phones->setLabel('Phone numbers')
               ->setOptions(array(
                   'count'          => 2,
                   'allow_add'      => true,
                   'allow_remove'   => true,
                   'target_element' => new PhoneFieldset($this->getServiceManager()),
               ));
        $this->add($phones);
    }



}
