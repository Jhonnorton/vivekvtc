<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class InventoryTransfer extends \Base\Entity\InventoryTransfer implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }



    /**
     * {@inheritDoc}
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', array($name, $value));

        return parent::__set($name, $value);
    }



    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'resortId', 'hotelName', 'supplierName', 'numberAvailable', 'dateTo', 'dateFrom', 'netPrice', 'grossPrice', 'costMultiplier', 'transferName', 'linkedTo', 'eventId', 'cruiseId', 'email', 'phone', 'notes', 'image');
        }

        return array('__isInitialized__', 'id', 'resortId', 'hotelName', 'supplierName', 'numberAvailable', 'dateTo', 'dateFrom', 'netPrice', 'grossPrice', 'costMultiplier', 'transferName', 'linkedTo', 'eventId', 'cruiseId', 'email', 'phone', 'notes', 'image');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (InventoryTransfer $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setResortId($resortId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResortId', array($resortId));

        return parent::setResortId($resortId);
    }

    /**
     * {@inheritDoc}
     */
    public function getResortId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResortId', array());

        return parent::getResortId();
    }

    /**
     * {@inheritDoc}
     */
    public function setHotelName($hotelName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHotelName', array($hotelName));

        return parent::setHotelName($hotelName);
    }

    /**
     * {@inheritDoc}
     */
    public function getHotelName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHotelName', array());

        return parent::getHotelName();
    }

    /**
     * {@inheritDoc}
     */
    public function setSupplierName($supplierName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSupplierName', array($supplierName));

        return parent::setSupplierName($supplierName);
    }

    /**
     * {@inheritDoc}
     */
    public function getSupplierName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSupplierName', array());

        return parent::getSupplierName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateTo($dateTo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateTo', array($dateTo));

        return parent::setDateTo($dateTo);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateTo', array());

        return parent::getDateTo();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateFrom($dateFrom)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateFrom', array($dateFrom));

        return parent::setDateFrom($dateFrom);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateFrom()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateFrom', array());

        return parent::getDateFrom();
    }

    /**
     * {@inheritDoc}
     */
    public function setNetPrice($netPrice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNetPrice', array($netPrice));

        return parent::setNetPrice($netPrice);
    }

    /**
     * {@inheritDoc}
     */
    public function getNetPrice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNetPrice', array());

        return parent::getNetPrice();
    }

    /**
     * {@inheritDoc}
     */
    public function setGrossPrice($grossPrice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGrossPrice', array($grossPrice));

        return parent::setGrossPrice($grossPrice);
    }

    /**
     * {@inheritDoc}
     */
    public function getGrossPrice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGrossPrice', array());

        return parent::getGrossPrice();
    }

    /**
     * {@inheritDoc}
     */
    public function setCostMultiplier($costMultiplier)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCostMultiplier', array($costMultiplier));

        return parent::setCostMultiplier($costMultiplier);
    }

    /**
     * {@inheritDoc}
     */
    public function getCostMultiplier()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCostMultiplier', array());

        return parent::getCostMultiplier();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumberAvailable($numberAvailable)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumberAvailable', array($numberAvailable));

        return parent::setNumberAvailable($numberAvailable);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumberAvailable()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumberAvailable', array());

        return parent::getNumberAvailable();
    }

    /**
     * {@inheritDoc}
     */
    public function setTransferName($transferName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTransferName', array($transferName));

        return parent::setTransferName($transferName);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransferName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTransferName', array());

        return parent::getTransferName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkedTo($linkedTo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLinkedTo', array($linkedTo));

        return parent::setLinkedTo($linkedTo);
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkedTo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLinkedTo', array());

        return parent::getLinkedTo();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventId($eventId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventId', array($eventId));

        return parent::setEventId($eventId);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventId', array());

        return parent::getEventId();
    }

    /**
     * {@inheritDoc}
     */
    public function setCruiseId($cruiseId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCruiseId', array($cruiseId));

        return parent::setCruiseId($cruiseId);
    }

    /**
     * {@inheritDoc}
     */
    public function getCruiseId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCruiseId', array());

        return parent::getCruiseId();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', array($email));

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', array());

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhone($phone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhone', array($phone));

        return parent::setPhone($phone);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhone', array());

        return parent::getPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setNotes($notes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNotes', array($notes));

        return parent::setNotes($notes);
    }

    /**
     * {@inheritDoc}
     */
    public function getNotes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotes', array());

        return parent::getNotes();
    }

    /**
     * {@inheritDoc}
     */
    public function setImage($image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImage', array($image));

        return parent::setImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImage', array());

        return parent::getImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setServiceManager($sm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServiceManager', array($sm));

        return parent::setServiceManager($sm);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceManager()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServiceManager', array());

        return parent::getServiceManager();
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityManager()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEntityManager', array());

        return parent::getEntityManager();
    }

    /**
     * {@inheritDoc}
     */
    public function getForm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getForm', array());

        return parent::getForm();
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCollection', array());

        return parent::getCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function toArray($object = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', array($object));

        return parent::toArray($object);
    }

    /**
     * {@inheritDoc}
     */
    public function toJson()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toJson', array());

        return parent::toJson();
    }

    /**
     * {@inheritDoc}
     */
    public function setCollection($collection)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCollection', array($collection));

        return parent::setCollection($collection);
    }

    /**
     * {@inheritDoc}
     */
    public function save()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'save', array());

        return parent::save();
    }

}
