<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class InventoryPromo extends \Base\Entity\InventoryPromo implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'id', 'promoNames', 'linkedTo', 'isActive', 'dateFrom', 'dateTo', 'discount', 'image', 'description', 'promoCode', 'discountType', 'numberAvailable', 'name', 'email', 'created', 'updated', 'promoType', 'validity', 'serviceManager');
        }

        return array('__isInitialized__', 'id', 'promoNames', 'linkedTo', 'isActive', 'dateFrom', 'dateTo', 'discount', 'image', 'description', 'promoCode', 'discountType', 'numberAvailable', 'name', 'email', 'created', 'updated', 'promoType', 'validity', 'serviceManager');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (InventoryPromo $proxy) {
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
    public function setvalidity($validity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setvalidity', array($validity));

        return parent::setvalidity($validity);
    }

    /**
     * {@inheritDoc}
     */
    public function getvalidity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getvalidity', array());

        return parent::getvalidity();
    }

    /**
     * {@inheritDoc}
     */
    public function setpromoType($promoType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setpromoType', array($promoType));

        return parent::setpromoType($promoType);
    }

    /**
     * {@inheritDoc}
     */
    public function getpromoType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getpromoType', array());

        return parent::getpromoType();
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
    public function setCreated($created)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreated', array($created));

        return parent::setCreated($created);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreated', array());

        return parent::getCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdated($updated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdated', array($updated));

        return parent::setUpdated($updated);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdated', array());

        return parent::getUpdated();
    }

    /**
     * {@inheritDoc}
     */
    public function setemail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setemail', array($email));

        return parent::setemail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getemail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getemail', array());

        return parent::getemail();
    }

    /**
     * {@inheritDoc}
     */
    public function setname($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setname', array($name));

        return parent::setname($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getname()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getname', array());

        return parent::getname();
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
    public function setPromoNames($promoNames)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPromoNames', array($promoNames));

        return parent::setPromoNames($promoNames);
    }

    /**
     * {@inheritDoc}
     */
    public function getPromoNames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPromoNames', array());

        return parent::getPromoNames();
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
    public function setIsActive($isActive)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsActive', array($isActive));

        return parent::setIsActive($isActive);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsActive()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsActive', array());

        return parent::getIsActive();
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
    public function setDiscount($discount)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiscount', array($discount));

        return parent::setDiscount($discount);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscount()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiscount', array());

        return parent::getDiscount();
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
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setPromoCode($promoCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPromoCode', array($promoCode));

        return parent::setPromoCode($promoCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getPromoCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPromoCode', array());

        return parent::getPromoCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiscountType($discountType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiscountType', array($discountType));

        return parent::setDiscountType($discountType);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscountType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiscountType', array());

        return parent::getDiscountType();
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
