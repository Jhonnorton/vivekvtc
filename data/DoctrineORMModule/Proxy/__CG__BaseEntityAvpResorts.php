<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity\Avp;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Resorts extends \Base\Entity\Avp\Resorts implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'id', '' . "\0" . 'Base\\Entity\\Avp\\Resorts' . "\0" . 'userId', 'title', 'pageHeading', 'overview', 'amenities', 'entertainment', 'image', 'orderNum', 'isFeatured', 'metaTitle', 'metaDescription', 'metaKeywords', 'addedOn', 'status', 'categoryId', 'countryId', 'popoverContent', 'popoverTitle', 'ratingId', 'parishId', 'price', 'addedToVp', 'isTour', 'isDeleted');
        }

        return array('__isInitialized__', 'id', '' . "\0" . 'Base\\Entity\\Avp\\Resorts' . "\0" . 'userId', 'title', 'pageHeading', 'overview', 'amenities', 'entertainment', 'image', 'orderNum', 'isFeatured', 'metaTitle', 'metaDescription', 'metaKeywords', 'addedOn', 'status', 'categoryId', 'countryId', 'popoverContent', 'popoverTitle', 'ratingId', 'parishId', 'price', 'addedToVp', 'isTour', 'isDeleted');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Resorts $proxy) {
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
    public function setUserId($userId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserId', array($userId));

        return parent::setUserId($userId);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserId', array());

        return parent::getUserId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', array($title));

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', array());

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setPageHeading($pageHeading)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPageHeading', array($pageHeading));

        return parent::setPageHeading($pageHeading);
    }

    /**
     * {@inheritDoc}
     */
    public function getPageHeading()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPageHeading', array());

        return parent::getPageHeading();
    }

    /**
     * {@inheritDoc}
     */
    public function setOverview($overview)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOverview', array($overview));

        return parent::setOverview($overview);
    }

    /**
     * {@inheritDoc}
     */
    public function getOverview()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOverview', array());

        return parent::getOverview();
    }

    /**
     * {@inheritDoc}
     */
    public function setAmenities($amenities)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmenities', array($amenities));

        return parent::setAmenities($amenities);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmenities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmenities', array());

        return parent::getAmenities();
    }

    /**
     * {@inheritDoc}
     */
    public function setEntertainment($entertainment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEntertainment', array($entertainment));

        return parent::setEntertainment($entertainment);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntertainment()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEntertainment', array());

        return parent::getEntertainment();
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
    public function setOrderNum($orderNum)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrderNum', array($orderNum));

        return parent::setOrderNum($orderNum);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrderNum()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrderNum', array());

        return parent::getOrderNum();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsFeatured($isFeatured)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsFeatured', array($isFeatured));

        return parent::setIsFeatured($isFeatured);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsFeatured()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsFeatured', array());

        return parent::getIsFeatured();
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaTitle($metaTitle)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMetaTitle', array($metaTitle));

        return parent::setMetaTitle($metaTitle);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMetaTitle', array());

        return parent::getMetaTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaDescription($metaDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMetaDescription', array($metaDescription));

        return parent::setMetaDescription($metaDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMetaDescription', array());

        return parent::getMetaDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaKeywords($metaKeywords)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMetaKeywords', array($metaKeywords));

        return parent::setMetaKeywords($metaKeywords);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaKeywords()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMetaKeywords', array());

        return parent::getMetaKeywords();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddedOn($addedOn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddedOn', array($addedOn));

        return parent::setAddedOn($addedOn);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddedOn', array());

        return parent::getAddedOn();
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
    public function setCategoryId($categoryId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategoryId', array($categoryId));

        return parent::setCategoryId($categoryId);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategoryId', array());

        return parent::getCategoryId();
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
    public function setPopoverContent($popoverContent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPopoverContent', array($popoverContent));

        return parent::setPopoverContent($popoverContent);
    }

    /**
     * {@inheritDoc}
     */
    public function getPopoverContent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPopoverContent', array());

        return parent::getPopoverContent();
    }

    /**
     * {@inheritDoc}
     */
    public function setPopoverTitle($popoverTitle)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPopoverTitle', array($popoverTitle));

        return parent::setPopoverTitle($popoverTitle);
    }

    /**
     * {@inheritDoc}
     */
    public function getPopoverTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPopoverTitle', array());

        return parent::getPopoverTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setRatingId($ratingId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRatingId', array($ratingId));

        return parent::setRatingId($ratingId);
    }

    /**
     * {@inheritDoc}
     */
    public function getRatingId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRatingId', array());

        return parent::getRatingId();
    }

    /**
     * {@inheritDoc}
     */
    public function setParishId($parishId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setParishId', array($parishId));

        return parent::setParishId($parishId);
    }

    /**
     * {@inheritDoc}
     */
    public function getParishId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParishId', array());

        return parent::getParishId();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice($price)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrice', array($price));

        return parent::setPrice($price);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrice', array());

        return parent::getPrice();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddedToVp($addedToVp)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddedToVp', array($addedToVp));

        return parent::setAddedToVp($addedToVp);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddedToVp()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddedToVp', array());

        return parent::getAddedToVp();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsTour($isTour)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsTour', array($isTour));

        return parent::setIsTour($isTour);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsTour()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsTour', array());

        return parent::getIsTour();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsDeleted', array());

        return parent::getIsDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDeleted($isDeleted)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDeleted', array($isDeleted));

        return parent::setIsDeleted($isDeleted);
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
