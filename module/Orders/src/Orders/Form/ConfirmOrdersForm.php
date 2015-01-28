<?php

namespace Orders\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ConfirmOrdersForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {
        
        $this->setObjectManager($objectManager); //git        
        $this->setAvpObjectManager($avpObjectManager);        
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('orders');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        
        //Accomodations

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resortId',
            'attributes' => array(
                'required' => 'required',
                'id'=>'resorts',
            ),
            'options' => array(
                'label' => 'Hotel Name',
                'object_manager' => $this->getAvpObjectManager(),
                'target_class' => 'Base\Entity\Avp\Resorts',
                'property' => 'title',
                'empty_option' => 'please select hotel...'
            ),
        ));

        /*
          $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
          $this->setHydrator($hydrator);
          $this->bind($this->getTargetEntity());
         */
    }

    public function setObjectManager(ObjectManager $objectManager) {

        $this->objectManager = $objectManager;
        return $this;
    }

    public function getObjectManager() {

        return $this->objectManager;
    }
    
    public function setAvpObjectManager(ObjectManager $avpObjectManager){
        
        $this->avpObjectManager = $avpObjectManager;
        return $this;
        
    }
    
    public function getAvpObjectManager() {

        return $this->avpObjectManager;
    }

    protected function getTargetEntity() {

        return $this->targetEntity;
    }

    protected function setTargetEntity($targetEntity) {

        if (!is_object($targetEntity)) {

            $this->targetEntity = new $targetEntity();
        } else {

            $this->targetEntity = $targetEntity;
        }
    }

    protected function getMonths() {
        return array(
            'Jan' => 'Jan',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Apr',
            'May' => 'May',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Aug',
            'Sep' => 'Sep',
            'Oct' => 'Oct',
            'Nov' => 'Nov',
            'Dec' => 'Dec',
        );
    }

    protected function getYears() {
        $years = array();
        for ($i = 1990; $i < 2100; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }

    protected function getText() {
        return 'Information:

Hotel Check -in is normally after 2pm. Please be aware that if you arrive before 2:00pm you may have to wait for rooms to become available. Check out is normally at midday on the day you are leaving. Your all-inclusive package includes all meals and drinks, including premium liquor. Please check the hotels website for a list of all all-inclusive amenities.

DOCUMENTATION:

Please be advise that a valid passport is required for travelling to any country outside of your legal country of residence. Please take your passport with you when travelling. It is your responsibility to have all necessary documentation required to enter the country. Please reference this link to verify documentation requirements www.visahq.com.  Please note that entry to another country may be refused even with complete documentation.

INSURANCE:

You have declined to book travel insurance with Sunset Destinations and adult Tours. Please be aware that it is your responsibility that all travellers have adequate travel insurance before departure.

PRICE CHANGE:

This invoice does not allow any price change after invoice is issued

LIVING CONDITIONS:

Please note that living standards, practices in other countries and the standards and conditions with respect to the provision of utilities, services and accommodations may diff¬er from those found in your home country.

CANCELLATION:

If you should cancel your reservation, your rights to a refund are limited as set forth below:
All cancelled reservations are subject to a 2.4% processing fee. All NO SHOWS or early departures are non-refundable Cancellations prior to 180 days are refundable minus the $45 per person processing fee.
Cancellation after 180 days prior up to 75 days prior to departure will attract a $250 per person penalty.
Cancellations within 75 days are 100% non refundable.
These charges are in addition to the charges made by the airlines, other hotels or resorts, car rental companies, or other places we may have purchased travel related services from for you on this trip. Airline tickets purchased for you, for example, normally are non-refundable You should assume all Payments made are non-refundable, unless we tell you otherwise
';
    }

    
    protected function addPaymentFields() {

        $this->add(array(
            'name' => 'paymentType',
            'attributes' => array(
                'type' => 'hidden',
                'readonly' => true,
                //'value'    => 1,
            ),
        ));
        
        
    
        $this->add(array(
            'name' => 'depositAmount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'readonly' => false,
            ),
            'options' => array(
                'label' => 'Deposit Amount',
            ),
        ));
        
         $this->add(array(
            'name' => 'depositMethod',
            'attributes' => array(
                'type' => 'hidden',
                'readonly' => true,
            ),
        ));
        
         $this->add(array(
            'name' => 'balansAfterDeposit',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'readonly' => true,
            ),
            'options' => array(
                'label' => 'Balans After Deposit',
            ),
        ));
         
         $this->add(array(
            'name' => 'nextPaymentDue',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'readonly' => true,
            ),
            'options' => array(
                'label' => 'Next Payment Due',
            ),
        ));
         
        $this->add(array(
            'name' => 'dueDate1',
            'attributes' => array(
                'type' => 'date',
            ),
            'options' => array(
                'label' => 'Due Date',
            ),
        ));
        
        $this->add(array(
            'name' => 'finalPaymentDue',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'readonly' => true,
            ),
            'options' => array(
                'label' => 'Final Payment Due',
            ),
        ));
        
        $this->add(array(
            'name' => 'dueDate2',
            'attributes' => array(
                'type' => 'date',
            ),
            'options' => array(
                'label' => 'Due Date',
            ),
        ));
    }

}


