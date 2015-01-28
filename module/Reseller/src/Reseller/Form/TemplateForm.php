<?php

namespace Reseller\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TemplateForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, $targetEntity) {
        //d($targetEntity);
        $this->setObjectManager($objectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('reseller');

        $this->setAttribute('method', 'post');
       
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));


       $this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type' => 'file',
                'accept' => 'image/*',
            ),
            'options' => array(
                'label' => 'Image',
            ),
        ));

       

        $this->add(array(
            'name' => 'cost',
            'attributes' => array(
                'type' => 'number',
            ),
            'options' => array(
                'label' => 'Cost',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));


        

         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));

        $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
        $this->setHydrator($hydrator);
        $this->bind($this->getTargetEntity());
    }

    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
        // d($this->objectManager);
        return $this;
    }

    public function getObjectManager() {
        return $this->objectManager;
    }

    protected function getTargetEntity() {
        //d($this->targetEntity);
        return $this->targetEntity;
    }

    protected function setTargetEntity($targetEntity) {
        if (!is_object($targetEntity)) {
            $this->targetEntity = new $targetEntity();
        } else {
            $this->targetEntity = $targetEntity;
        }
    }

}
