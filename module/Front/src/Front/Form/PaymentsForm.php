<?php

namespace Front\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PaymentsForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, $targetEntity) {
        $this->setObjectManager($objectManager); //git
        $this->setTargetEntity($targetEntity);


        // we want to ignore the name passed
        parent::__construct('front');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id[]',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'fullPayment',
            'options' => array(
                'label' => 'Full Payment',
                'value_options' => array(
                    '1' => 'Full Payment ',
                ),
            ),
            'attributes' => array(
                'value' => '0'
            )
        ));

        $this->add(array(
            'name' => 'depositDueAmount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => '0.00'
            ),
            'options' => array(
                'label' => 'Deposit Due Amount',
            ),
        ));

        $this->add(array(
            'name' => 'depositDueDate1',
            'attributes' => array(
                'type' => 'date',
                'required' => 'required',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Deposit Due Date1',
            ),
        ));


        $this->add(array(
            'name' => 'depositDueAmount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => '0.00'
            ),
            'options' => array(
                'label' => 'Deposit Due Amount',
            ),
        ));

        $this->add(array(
            'name' => 'depositDueDate1',
            'attributes' => array(
                'type' => 'date',
                'required' => 'required',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Deposit Due Date1',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'rcvdDue',
            'options' => array(
                'label' => 'Full Payment',
                'value_options' => array(
                    '0' => 'RCVD ',
                    '1' => 'DUE',
                ),
            ),
            'attributes' => array(
                'value' => '1'
            )
        ));

        $this->add(array(
            'name' => 'depositDueAmount2',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => '0.00'
            ),
            'options' => array(
                'label' => 'Deposit Due Amount 2',
            ),
        ));

        $this->add(array(
            'name' => 'depositDueDate2',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Deposit Due Date 2',
            ),
        ));

        $this->add(array(
            'name' => 'depositDueAmount3',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => '0.00'
            ),
            'options' => array(
                'label' => 'Deposit Due Amount 3',
            ),
        ));

        $this->add(array(
            'name' => 'depositDueDate3',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Deposit Due Date 3',
            ),
        ));


        $this->add(array(
            'name' => 'transferAmount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => '0.00'
            ),
            'options' => array(
                'label' => 'Transfer Amount ',
            ),
        ));

         $this->add(array(
            'name' => 'typeOfCard',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,                
                'readonly' => true,
            ),
            'options' => array(
                'label' => 'Type Of Card',
            ),
        ));

        $this->add(array(
            'name' => 'cardNumber',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
            ),
            'options' => array(
                'label' => 'Card Number',
            ),
        ));

        $this->add(array(
            'name' => 'cvvNumber',
            'attributes' => array(
                'type' => 'number',
               //'min' => 0,
                //'disabled' => true,
            ),
            'options' => array(
                'label' => 'CVV Number',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'typeOfCard',
            'options' => array(
                'label' => 'Type Of Card',
                'value_options' => array(
                    'MasterCard' => 'MasterCard',
                    'Visa' => 'Visa',
                ),
                'empty_option' => 'Select Card Type'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cardMonth',
            'options' => array(
                'label' => 'Card Expiry Date',
                'value_options' => $this->getMonths(),
                'empty_option' => 'MM'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cardYear',
            'options' => array(
                'label' => 'Card Expiry Date',
                'value_options' => $this->getYears(),
                'empty_option' => 'YYYY'
            )
        ));
        
        
       $this->add(array(
            'name' => 'totalCost',
            'attributes' => array(
                'type' => 'number',                
                'min' => 0,
                'value'=>0,
                //'readonly'=>true,
                
            ),
            'options' => array(
                'label' => 'Total',
            ),
        ));
        
        $this->add(array(
            'name' => 'billProcess',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));
        
         $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'billCountry',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Countries',
                'property' => 'countryName',
                'empty_option' => 'please select country...'
            ),
        ));
        
        $this->add(array(
            'name' => 'ok',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Submit',
                'id' => 'submitbutton',
                'onclick' => 'javascript:alert("Module in progress")'
            ),
        ));

            $this->addPaymentFields();   
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
            'name' => 'dueid[]',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        
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
            'name' => 'nextPaymentDue[]',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'readonly' => false,
            ),
            'options' => array(
                'label' => 'Next Payment Due',
            ),
        ));
         
        $this->add(array(
            'name' => 'dueDate1[]',
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
                'readonly' => false,
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

