<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Vouchers extends \Base\Entity\Vouchers implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'id', 'voucherCode', 'voucherName', 'templateId', 'type', 'receipientName', 'email', 'linkToType', 'linkToTypeName', 'discount', 'numberOfUse', 'isUnlimited', 'details', 'image', 'fromDate', 'toDate', 'created', 'serviceManager');
        }

        return array('__isInitialized__', 'id', 'voucherCode', 'voucherName', 'templateId', 'type', 'receipientName', 'email', 'linkToType', 'linkToTypeName', 'discount', 'numberOfUse', 'isUnlimited', 'details', 'image', 'fromDate', 'toDate', 'created', 'serviceManager');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Vouchers $proxy) {
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
    public function setVoucherCode($voucherCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVoucherCode', array($voucherCode));

        return parent::setVoucherCode($voucherCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getVoucherCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVoucherCode', array());

        return parent::getVoucherCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setVoucherName($voucherName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVoucherName', array($voucherName));

        return parent::setVoucherName($voucherName);
    }

    /**
     * {@inheritDoc}
     */
    public function getVoucherName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVoucherName', array());

        return parent::getVoucherName();
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplateId($templateId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTemplateId', array($templateId));

        return parent::setTemplateId($templateId);
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplateId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTemplateId', array());

        return parent::getTemplateId();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', array($type));

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', array());

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setReceipientName($receipientName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReceipientName', array($receipientName));

        return parent::setReceipientName($receipientName);
    }

    /**
     * {@inheritDoc}
     */
    public function getReceipientName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReceipientName', array());

        return parent::getReceipientName();
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
    public function setLinkToType($linkToType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLinkToType', array($linkToType));

        return parent::setLinkToType($linkToType);
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkToType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLinkToType', array());

        return parent::getLinkToType();
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkToTypeName($linkToTypeName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLinkToTypeName', array($linkToTypeName));

        return parent::setLinkToTypeName($linkToTypeName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkToTypeName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLinkToTypeName', array());

        return parent::getLinkToTypeName();
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
    public function setNumberOfUse($numberOfUse)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumberOfUse', array($numberOfUse));

        return parent::setNumberOfUse($numberOfUse);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumberOfUse()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumberOfUse', array());

        return parent::getNumberOfUse();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsUnlimited($isUnlimited)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsUnlimited', array($isUnlimited));

        return parent::setIsUnlimited($isUnlimited);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsUnlimited()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsUnlimited', array());

        return parent::getIsUnlimited();
    }

    /**
     * {@inheritDoc}
     */
    public function setDetails($details)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDetails', array($details));

        return parent::setDetails($details);
    }

    /**
     * {@inheritDoc}
     */
    public function getDetails()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDetails', array());

        return parent::getDetails();
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
    public function setFromDate($fromDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFromDate', array($fromDate));

        return parent::setFromDate($fromDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getFromDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFromDate', array());

        return parent::getFromDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setToDate($toDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setToDate', array($toDate));

        return parent::setToDate($toDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getToDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getToDate', array());

        return parent::getToDate();
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
