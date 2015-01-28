<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity\Avp;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Users extends \Base\Entity\Avp\Users implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'id', 'uniqueId', 'role', 'firstName', 'lastName', 'dob', 'email', 'password', 'addressLine1', 'addressLine2', 'city', 'state', 'countryId', 'zip', 'status', 'tmpPassword', 'isApproved', 'joinedOn', 'lastUpdated');
        }

        return array('__isInitialized__', 'id', 'uniqueId', 'role', 'firstName', 'lastName', 'dob', 'email', 'password', 'addressLine1', 'addressLine2', 'city', 'state', 'countryId', 'zip', 'status', 'tmpPassword', 'isApproved', 'joinedOn', 'lastUpdated');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Users $proxy) {
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
    public function setUniqueId($uniqueId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUniqueId', array($uniqueId));

        return parent::setUniqueId($uniqueId);
    }

    /**
     * {@inheritDoc}
     */
    public function getUniqueId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUniqueId', array());

        return parent::getUniqueId();
    }

    /**
     * {@inheritDoc}
     */
    public function setRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRole', array($role));

        return parent::setRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRole', array());

        return parent::getRole();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', array($firstName));

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', array());

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', array($lastName));

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', array());

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDob($dob)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDob', array($dob));

        return parent::setDob($dob);
    }

    /**
     * {@inheritDoc}
     */
    public function getDob()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDob', array());

        return parent::getDob();
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
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', array($password));

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', array());

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddressLine1($addressLine1)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddressLine1', array($addressLine1));

        return parent::setAddressLine1($addressLine1);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddressLine1()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddressLine1', array());

        return parent::getAddressLine1();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddressLine2($addressLine2)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddressLine2', array($addressLine2));

        return parent::setAddressLine2($addressLine2);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddressLine2()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddressLine2', array());

        return parent::getAddressLine2();
    }

    /**
     * {@inheritDoc}
     */
    public function setCity($city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCity', array($city));

        return parent::setCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCity', array());

        return parent::getCity();
    }

    /**
     * {@inheritDoc}
     */
    public function setState($state)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setState', array($state));

        return parent::setState($state);
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getState', array());

        return parent::getState();
    }

    /**
     * {@inheritDoc}
     */
    public function setCountryId($countryId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCountryId', array($countryId));

        return parent::setCountryId($countryId);
    }

    /**
     * {@inheritDoc}
     */
    public function getCountryId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCountryId', array());

        return parent::getCountryId();
    }

    /**
     * {@inheritDoc}
     */
    public function setZip($zip)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setZip', array($zip));

        return parent::setZip($zip);
    }

    /**
     * {@inheritDoc}
     */
    public function getZip()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getZip', array());

        return parent::getZip();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', array($status));

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', array());

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setTmpPassword($tmpPassword)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTmpPassword', array($tmpPassword));

        return parent::setTmpPassword($tmpPassword);
    }

    /**
     * {@inheritDoc}
     */
    public function getTmpPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTmpPassword', array());

        return parent::getTmpPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsApproved($isApproved)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsApproved', array($isApproved));

        return parent::setIsApproved($isApproved);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsApproved()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsApproved', array());

        return parent::getIsApproved();
    }

    /**
     * {@inheritDoc}
     */
    public function setJoinedOn($joinedOn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setJoinedOn', array($joinedOn));

        return parent::setJoinedOn($joinedOn);
    }

    /**
     * {@inheritDoc}
     */
    public function getJoinedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJoinedOn', array());

        return parent::getJoinedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastUpdated($lastUpdated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastUpdated', array($lastUpdated));

        return parent::setLastUpdated($lastUpdated);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastUpdated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastUpdated', array());

        return parent::getLastUpdated();
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
