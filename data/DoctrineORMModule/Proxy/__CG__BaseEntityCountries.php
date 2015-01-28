<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Countries extends \Base\Entity\Countries implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'id', 'iso2', 'numcode', 'unMember', 'code', 'countryName', 'currency', 'searchName', 'cctld');
        }

        return array('__isInitialized__', 'id', 'iso2', 'numcode', 'unMember', 'code', 'countryName', 'currency', 'searchName', 'cctld');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Countries $proxy) {
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
    public function setCode($code)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCode', array($code));

        return parent::setCode($code);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCode', array());

        return parent::getCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setCountryName($countryName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCountryName', array($countryName));

        return parent::setCountryName($countryName);
    }

    /**
     * {@inheritDoc}
     */
    public function getCountryName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCountryName', array());

        return parent::getCountryName();
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrency($currency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrency', array($currency));

        return parent::setCurrency($currency);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrency', array());

        return parent::getCurrency();
    }

    /**
     * {@inheritDoc}
     */
    public function setSearchName($searchName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSearchName', array($searchName));

        return parent::setSearchName($searchName);
    }

    /**
     * {@inheritDoc}
     */
    public function getSearchName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSearchName', array());

        return parent::getSearchName();
    }

    /**
     * {@inheritDoc}
     */
    public function setIso2($iso2)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIso2', array($iso2));

        return parent::setIso2($iso2);
    }

    /**
     * {@inheritDoc}
     */
    public function getIso2()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIso2', array());

        return parent::getIso2();
    }

    /**
     * {@inheritDoc}
     */
    public function setLongName($longName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLongName', array($longName));

        return parent::setLongName($longName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLongName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLongName', array());

        return parent::getLongName();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumcode($numcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumcode', array($numcode));

        return parent::setNumcode($numcode);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumcode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumcode', array());

        return parent::getNumcode();
    }

    /**
     * {@inheritDoc}
     */
    public function setUnMember($unMember)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUnMember', array($unMember));

        return parent::setUnMember($unMember);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUnMember', array());

        return parent::getUnMember();
    }

    /**
     * {@inheritDoc}
     */
    public function setCctld($cctld)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCctld', array($cctld));

        return parent::setCctld($cctld);
    }

    /**
     * {@inheritDoc}
     */
    public function getCctld()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCctld', array());

        return parent::getCctld();
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