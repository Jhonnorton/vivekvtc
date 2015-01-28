<?php

namespace Reseller\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;

class Reseller extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $models = null;

    const DAYS_120_BEFORE = 1;
    const DAYS_120_90_BEFORE = 2;
    const DAYS_60_AND_LESS_BEFORE = 3;
    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;
    const CANCELED = 0;
    const OPEN_BALANCE = 1;
    const CLOSED_BALANCE = 2;

    //public static $srcDestination = '/home/isteam/public_html/rmv/public/img/user_uploads/'; // Development staging!!!!!!!!
//    public static $imagesBaseUrl = 'http://192.155.246.146:9084/app/webroot/img/user_uploads/'; //Development Staging

    public function getImagePath() {
        return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'event/thumbnails_80x80/';
    }

    protected $_imageOptions = array(
        //img 80x80
        array(
            'options' => array('width' => 80, 'height' => 80),
            'destination' => 'event/thumbnails_80x80/'
        ),
        //img 150x150
        array(
            'options' => array('width' => 150, 'height' => 150),
            'destination' => 'event/thumbnails_150x150/'
        ),
        //img 291x194
        array(
            'options' => array('width' => 291, 'height' => 194),
            'destination' => 'event/image_291x194/'
        ),
        //img 202x144
        array(
            'options' => array('width' => 202, 'height' => 144),
            'destination' => 'event/image_202x144/'
        ),
        //img 288x161
        array(
            'options' => array('width' => 288, 'height' => 161),
            'destination' => 'event/image_288x161/'
        ),
        //img 622x268
        array(
            'options' => array('width' => 622, 'height' => 268),
            'destination' => 'event/image_622x268/'
        ),
        //img 701x456
        array(
            'options' => array('width' => 701, 'height' => 456),
            'destination' => 'event/image_701x456/'
        ),
        //img large 800x600
        array(
            'options' => array('width' => 800, 'height' => 600),
            'destination' => 'event/large/'
        ),
        //img
        array(
            'options' => null,
            'destination' => 'event/'
        )
    );
    
    protected $_cruiseImageOptions = array(
        //img 80x80
        array(
            'options' => array('width' => 80, 'height' => 80),
            'destination' => 'cruise/thumbnails_80x80/'
        ),
        //img 150x150
        array(
            'options' => array('width' => 150, 'height' => 150),
            'destination' => 'cruise/thumbnails_150x150/'
        ),
        //img 291x194
        array(
            'options' => array('width' => 202, 'height' => 144),
            'destination' => 'cruise/thumbnails_202x144/'
        ),
        //img 202x144
        array(
            'options' => array('width' => 288, 'height' => 196),
            'destination' => 'cruise/thumbnails_288x196/'
        ),
        //img 288x161
        array(
            'options' => array('width' => 288, 'height' => 161),
            'destination' => 'cruise/thumbnails_288x161/'
        ),
        //img 622x268
        array(
            'options' => array('width' => 158, 'height' => 106),
            'destination' => 'cruise/thumbnails_158x106/'
        ),
        //img 701x456
        array(
            'options' => array('width' => 701, 'height' => 456),
            'destination' => 'cruise/image_701x456/'
        ),
        //img large 800x600
        array(
            'options' => array('width' => 800, 'height' => 600),
            'destination' => 'cruise/large/'
        ),
        
        //img
        array(
            'options' => null,
            'destination' => 'cruise/'
        )
    );
    
    protected $_templateImageOptions = array(
        //img 80x80
        array(
            'options' => array('width' => 800, 'height' => 600),
            'destination' => 'reseller_theme/'
        ),
   );

    public function __construct($serviceManager, $targetEntity = false) {
        parent::__construct($serviceManager, $targetEntity);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();



            $inputFilter->add($factory->createInput(array(
                        'name' => 'password',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'repassword',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'email',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'EmailAddress',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 5,
                                    'max' => 64,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'firstName',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 2,
                                    'max' => 64,
                                ),
                            ),
                        ),
            )));



            $inputFilter->add($factory->createInput(array(
                        'name' => 'lastName',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 2,
                                    'max' => 64,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'phone',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 8,
                                    'max' => 64,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'address',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 2,
                                ),
                            ),
                        ),
            )));



            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    protected function isValidEmail($object) {
        if ($this->checkItem(array('email' => $object->getData()->getEmail()))) {
            $object->get('email')->setMessages(array('User with this email already exists'));
            return false;
        }
        return true;
    }

    protected function isValidPhone($object) {

        if (!$object->getData()->getPhone())
            return true;
        if ($this->checkItem(array('phone' => $object->getData()->getPhone()))) {
            $object->get('phone')->setMessages(array('User with this phone already exists'));
            return false;
        }
        return true;
    }

    public function isValidModel($object) {

        return true;
    }

    public function isValidImage($form, $files) {
        if (empty($files['image']['name']))
            return true;
        $size = (int) $files['image']['size'];
        if ($size == 0 || $this->_maxImageSize < $size) {
            $form->get('image')->setMessages(array('Max size 2 Mb'));
            return false;
        }
        $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array($files['image']['type'], $types)) {
            $form->get('image')->setMessages(array('Invalid file type. Upload images: *.gif, *.png, *.jpg'));
            return false;
        }
        return true;
    }

    public function eventsave($object) {
        //d($object);

        $obj = $object['object'];
        //d($obj);
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Events', (int) $obj['id']);
        $date = getdate();

        $entity->setResortId($obj['resortId']);
        $entity->setTitle($obj['title']);
        $entity->setPageHeading($obj['pageHeading']);
        $entity->setCategoryId($obj['categoryId']);
        $entity->setStartDate(new \DateTime($obj['startDate']));
        $entity->setEndDate(new \DateTime($obj['endDate']));
        $entity->setMinimumStayDays($obj['minimumStayDays']);
        $entity->setOverview($obj['overview']);
        
        $entity->setIsSignatured($obj['isSignatured']);
        $entity->setType($obj['type']);
        $entity->setStatus($obj['status']);
        $entity->setApproved($obj['approved']);
        $entity->setMetaTitle($obj['metaTitle']);
        $entity->setMetaDescription($obj['metaDescription']);
        $entity->setMetaKeywords($obj['metaKeywords']);


        if (!empty($object['files']['image']['name'])) {

            $entity->setImage($date[0] . '-' . $obj['image']);
        }if ($object['files']['bannerImage']['name']) {
            //  d('here in banner');  
            $entity->setBannerImage($date[0] . '-' . $obj['bannerImage']);
        }if ($object['files']['listingImage']['name']) {
            $entity->setListingImage($date[0] . '-' . $obj['listingImage']);
        }
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();

        if ($object['files']['image']['name']) {
            $this->saveImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        }if ($object['files']['bannerImage']['name']) {
            $this->saveImages($object['files']['bannerImage']['tmp_name'], $date[0] . '-' . $obj['bannerImage']);
        }if ($object['files']['listingImage']['name']) {
            $this->saveImages($object['files']['listingImage']['tmp_name'], $date[0] . '-' . $obj['listingImage']);
        }

        //  d('success');
        return $event;
    }

    protected function saveImages($tmpName, $imgName) {

        foreach ($this->_imageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }

    protected function saveCruiseImages($tmpName, $imgName) {

        foreach ($this->_cruiseImageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }
    protected function saveTemplateImages($tmpName, $imgName) {

        foreach ($this->_templateImageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }
    
    private function _getStatus($statudId) {
        switch ($statudId) {
            case self::CANCELED:
                return 'Canceled';
            case self::OPEN_BALANCE:
                return 'Open Balance';
            case self::CLOSED_BALANCE:
                return 'Closed Balance';
            default :
                return '';
        }
    }

    public function getCollectiosssn($page = false) {

        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findAll();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'affiliate' => $item,
                'regdate' => $item->getUserId()->getJoinedOn(),
                'ordercount' => $this->_getReservationCount($item->getId()),
               
            );
        }

        // d($newCollection);
        return $newCollection;
    }

    protected function _getReservationCount($affiliateId) {

        $em = $this->getEntityManager();

        // $travellers = array();

        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId));

        // d( count($collection) );   
        return count($collection);
    }

    public function getOrders($page = false) {

        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findAll();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'affiliate' => $item,
                'regdate' => $item->getUserId()->getJoinedOn(),
                'ordercount' => $this->_getReservationCount($item->getId()),
                'orderevent' => $this->_getEventCount($item->getId()),
                'orderresort' => $this->_getResortCount($item->getId()),
                'ordercruise' => $this->_getCruiseCount($item->getId()),
                'grossorder' => $this->_getGrossTotal($item->getId()));
        }

        // d($newCollection);
        return $newCollection;
    }

    public function getOrderHistory($affiliateId, $page = false) {

        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                ->where('e.affiliateId=:affiliateId')
                ->setParameter('affiliateId', $affiliateId);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        $newCollection = array();
        //d($collection);
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'reservation' => $item,
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
            );
        }






        //d($newCollection);
        return $newCollection;
    }

    public function getResellerEvent($page = false) {

        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\Events', 'er')
                ->innerJoin('\Base\Entity\Avp\Affiliates', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.userId = e.userId')
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
      //  d($collection);
        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'events' => $item,
                'eventfeature' => $this->_getEventFeature($item->getUserId()->getId(),$item->getId()),
              
               
            );
        }

        //d('here');
        // d($collection);
        return $newCollection;
    }
    
     protected function _getEventFeature($userId, $eventId) {
        // d($eventId);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\FeatureOptions')->findBy(array('userId' => $userId, 'eventId' =>$eventId));
        
       // d($collection);
        return $collection;
    }


    protected function _getEvents($reservationId, $type) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId, 'type' => 2));
        return count($collection);
    }

    protected function _getHotelName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getRoom()->getHotelName() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getEventRoom()->getEventName() : null;
                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getCabin()->getCruiseName() : null;
                break;
        }

        return $name;
    }

    protected function _getInvoiceDetails($affiliateId) {

        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                ->where('e.affiliateId=:affiliateId')
                ->setParameter('affiliateId', $affiliateId);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        //d('here');
        return $collection;
    }

    protected function _getGrossTotal($affiliateId) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId));
        $totalcost = 0;
        foreach ($collection as $item) {
            $totalcost = $totalcost + $item->getFinalCost();
        }
        return $totalcost;
    }

    protected function _getEventCount($affiliateId) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId, 'type' => 2));
        return count($collection);
    }

    protected function _getResortCount($affiliateId) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId, 'type' => 1));
        return count($collection);
    }

    protected function _getCruiseCount($affiliateId) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Reservation')->findBy(array('affiliateId' => $affiliateId, 'type' => 3));
        return count($collection);
    }

    public function getItemView($id) {

        $collection = $this->getCollection();

        return $collection[$id];
    }

    public function save($object, $data) {

        if (!$this->isValidMd5($object->getPassword())) {

            $object->setPassword(md5($object->getPassword()));
        }
        $role = $this->getEntityManager()->getRepository('\Base\Entity\Role')->findOneBy(array('id' => 2));
        $object->setRole($role);
        $object->setJoinedOn(new \DateTime);
        $user = parent::save($object);
        // d($users);
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\Affiliates;
        $entity->setUserId($user);
        $entity->setAffiliatePackageId(0);
        $name = isset($data['firstName']) ? $data['firstName'] : null;
        if ($name) {
            $entity->setName($name);
        }
        $companyname = isset($data['companyName']) ? $data['companyName'] : null;
        if ($companyname) {
            $entity->setCompanyName($companyname);
        }
        if ($data['phone']) {
            $entity->setPhone($data['phone']);
        }
        if ($data['email']) {
            $entity->setEmail($data['email']);
        }
        if ($data['city']) {
            $entity->setCity($data['city']);
        }
        if ($data['state']) {
            $entity->setState($data['state']);
        }
        if ($data['country']) {
            $entity->setCountryId($data['country']);
        }
        $affliatekey = strtoupper(substr(md5(mt_rand()), 0, 30));
        $entity->setAffiliateKey($affliatekey);
        if ($data['apiKey']) {
            $entity->setApiKey($data['apiKey']);
        }
        if ($data['address']) {
            $entity->setAddressLine1($data['address']);
        }
        $entity->setIsApproved('1');
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        // d('success');
        // $this->_setReservationPaymentDue($user, $object);
    }

    public function isValidMd5($md5) {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    public function getItemViewDetail($id) {

        $collection = $this->getCollectiosssn();

        return $collection[$id];
    }

    public function isValidModelOnEdit($object) {

        if (!$this->checkItem(array(
                    'email' => $object->getData()->getEmail(),
                    'id' => $object->getData()->getId()))
        ) {
            if (!$this->isValidEmail($object))
                return false;
        }
        if (!$this->checkItem(array(
                    'phone' => $object->getData()->getPhone(),
                    'id' => $object->getData()->getId()))
        ) {
            if (!$this->isValidPhone($object))
                return false;
        }

        return true;
    }

    public function update($object, $data) {

        //d($data);
        if (!$this->isValidMd5($object->getPassword())) {

            $object->setPassword(md5($object->getPassword()));
        }

        $user = parent::save($object);

        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Affiliates', (int) $data['affiliateid']);
        // d($entity);
        $entity->setUserId($user);
        $entity->setAffiliatePackageId(0);
        $name = isset($data['firstName']) ? $data['firstName'] : null;
        if ($name) {
            $entity->setName($name);
        }
        $companyname = isset($data['companyName']) ? $data['companyName'] : null;
        if ($companyname) {
            $entity->setCompanyName($companyname);
        }
        if ($data['phone']) {
            $entity->setPhone($data['phone']);
        }
        if ($data['email']) {
            $entity->setEmail($data['email']);
        }
        if ($data['city']) {
            $entity->setCity($data['city']);
        }
        if ($data['state']) {
            $entity->setState($data['state']);
        }
        if ($data['country']) {
            $entity->setCountryId($data['country']);
        }

        if ($data['address']) {
            $entity->setAddressLine1($data['address']);
        }
        //$entity->setIsApproved('1');
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    public function getEventGallery($eventid = null) {
        // d($eventid);
        $em = $this->getEntityManager();

        $collection = $em->getRepository('Base\Entity\Avp\EventImages')->findBy(array('eventId' => $eventid));

        //  d($collection);
        return $collection;
    }

    public function eventimagesave($object) {

        $obj = $object['object'];

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\EventImages;

        $date = getdate();
        $entity->setEventId($obj['id']);
        $entity->setTitle($obj['title']);
        $entity->setImage($date[0] . '-' . $obj['image']);
        $entity->setAddedOn(new \DateTime);
        $em->persist($entity);
        $em->flush();

        $this->saveImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        return $event;
    }

    public function deleteimage($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('Base\Entity\Avp\EventImages', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }

    public function getEventFeature($eventid = null) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('Base\Entity\Avp\EventFeatures')->findBy(array('eventId' => $eventid));
        return $collection;
    }

    public function eventfeaturesave($object) {

        $obj = $object['object'];

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\EventFeatures;

        $date = getdate();
        $entity->setEventId($obj['id']);
        $entity->setTitle($obj['title']);
        $entity->setDescription($obj['description']);
        $entity->setImage($date[0] . '-' . $obj['image']);
        $entity->setAddedOn(new \DateTime);
        $em->persist($entity);
        $em->flush();

        $this->saveImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        return $event;
    }

    public function eventfeatureupdate($object) {
        //d($object);

        $obj = $object['object'];
        //    d($obj);
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\EventFeatures', (int) $obj['id']);
        //  d($entity);

        $date = getdate();
        if (!empty($object['files']['image']['name'])) {

            $entity->setImage($date[0] . '-' . $obj['image']);
        }


        $entity->setTitle($obj['title']);
        $entity->setDescription($obj['description']);


        $em->persist($entity);
        $em->flush();

        if ($object['files']['image']['name']) {
            $this->saveImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        }

        //  d('success');
        return $event;
    }

    public function deletefeature($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('Base\Entity\Avp\EventFeatures', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }

    public function getEventItineraries($eventid = null) {

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\EventItinerarySchedules', 'er')
                ->innerJoin('\Base\Entity\Avp\EventItineraries', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.eventItineraryId = e.id')
                ->where('e.eventId=:eventid')
                ->setParameter('eventid', $eventid);
        $query = $qb->getQuery();
        $collection = $query->getResult();

        //d($collection);

        return $collection;
    }

    public function eventitinerarysave($object) {
        $obj = $object['object'];
        //d($obj);

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\EventItineraries;

        $entity->setEventId($obj['eventid']);
        $entity->setEventDate(new \DateTime($obj['date']));
        $entity->setLastUpdated(new \DateTime);
        $em->persist($entity);
        $itinery = $em->flush();
        //d($entity->getId());

        $entity1 = new \Base\Entity\Avp\EventItinerarySchedules;
        $entity1->setEventItineraryId($entity);
        $entity1->setTitle($obj['title']);
        $entity1->setTime(new \DateTime($obj['time']));
        $em->persist($entity1);
        $em->flush();
        return;
        // d('success');
        //return $event;
    }

    public function eventitinerariesupdate($object) {
        $obj = $object['object'];
        //   d($obj);
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\EventItinerarySchedules', (int) $obj['id']);
        $entity->setTitle($obj['title']);
        $entity->setTime(new \DateTime($obj['time']));
        $em->persist($entity);
        $em->flush();

        //  d('success');
        //return $event;
    }

    public function deleteitinerary($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('Base\Entity\Avp\EventItinerarySchedules', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }

    public function getEventRooms($eventid = null) {

        $em = $this->getEntityManager();
        $collection = $em->getRepository('Base\Entity\Avp\EventRooms')->findBy(array('eventId' => $eventid));

        //d($collection);

        return $collection;
    }

    public function resortrooms($eventid = null, $resortid = null) {

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('Base\Entity\Avp\ResortRooms', 'er')
                ->where('er.resortId=:resortid')
                ->setParameter('resortid', $resortid)
                ->andWhere('e.eventId =:event')
                ->setParameter('event', $eventid)
                ->innerJoin('\Base\Entity\Avp\EventRooms', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.id != e.roomId')
        ;


        $query = $qb->getQuery();   //echo $query->getSql();die;

        $collection = $query->getResult();
       // d($collection);
        return $collection;
    }

    public function eventroomsave($object) {
        $obj = $object['object'];
        //d($object);die;
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\EventRooms;
        //echo $obj->roomId;die;
        //$entity->setRoomId($obj->roomid);
        
        $roomId = $em->find('Base\Entity\Avp\ResortRooms', (int) $obj->roomid);
        
        $entity->setRoomId($roomId);
        
        $entity->setEventId($obj->eventid);


        $entity->setRoomPrice($obj->roomPrice);

        $entity->setRoomPriceCad($obj->roomPriceCad);

        // d('heer room Cad');
        $entity->setRoomCategory($obj->roomcategory);


        $entity->setAddedOn(new \DateTime);

        //d('heer room added');
        $em->persist($entity);
        $em->flush();

        return;
    }

    public function eventroomsupdate($object) {
        $obj = $object['object'];
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\EventRooms', (int) $obj['id']);

        $entity->setRoomPrice($obj['roomPrice']);

        $entity->setRoomPriceCad($obj['roomPriceCad']);

        $entity->setStatus($obj['status']);
        $entity->setRoomCategory($obj['roomCategory']);
        $em->persist($entity);
        $em->flush();


        return;
    }
    
      public function deleterooms($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('\Base\Entity\Avp\EventRooms', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }
    
    public function setfeature($object) {
        
       // d($object->getUserId());die;
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\FeatureOptions;
      
        $entity->setUserId($object->getUserId());
        
        $entity->setUserRole('affiliate');


        $entity->setEventId($object->getId());
        
        $entity->setCruiseId(0);
        
        $entity->setResortId(0);

        $entity->setStatus('1');

    
        $entity->setCreated(new \DateTime);
        
        
        $entity->setModified(new \DateTime);

        $em->persist($entity);
        $em->flush();
//d('success');
        return;
    }
    
        public function unetfeature($object) {
    
        $em = $this->getEntityManager();

        $collection = $em->getRepository('\Base\Entity\Avp\FeatureOptions')->findBy(array('userId' => $object->getUserId(), 'eventId' =>$object->getId()));
        $id=$collection[0]->getId();
        $qb = $em->createQueryBuilder();
     
        $qb->delete('\Base\Entity\Avp\FeatureOptions', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }
    
    public function deleteevent($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('\Base\Entity\Avp\Events', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }
    
    
    public function getResellerResort($page = false) {

        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\Resorts', 'er')
                ->innerJoin('\Base\Entity\Avp\Affiliates', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.userId = e.userId')
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
    // d($collection);
        $newCollection = array();
        foreach ($collection as $item) {

            $newCollection[$item->getId()] = array(
                'resorts' => $item,
                'eventfeature' => $this->_getResortFeature($item->getUserId()->getId(),$item->getId()),
          );
        }

        return $newCollection;
    }
    
     protected function _getResortFeature($userId, $resortId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\FeatureOptions')->findBy(array('userId' => $userId, 'resortId' =>$eventId));
    
        return $collection;
    }
    
     public function getResellerCruise($page = false) {

        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\Cruises', 'er')
                ->innerJoin('\Base\Entity\Avp\Affiliates', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.userId = e.userId')
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     
     public function getResellerCruiseDetails($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\Cruises', 'er')
                ->where('er.id='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        $newCollection=array();
        
        $newCollection['cruise']=$collection[0];
        $newCollection['cruiseCabins']=$this->_getCruiseCabins($id);
        $newCollection['cruiseItinerary']=$this->_getCruiseItinerary($id);
        $newCollection['cruisePorts']=$this->_getCruisePorts($id);
//        d($newCollection);
        return $newCollection;
     }

     public function _getCruiseCabins($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\CruiseCabins', 'er')
                ->where('er.cruiseId='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     public function _getCruiseItinerary($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\CruiseItineraries', 'er')
                ->where('er.cruiseId='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     public function _getCruisePorts($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\CruisePorts', 'er')
                ->where('er.cruiseId='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     public function getResellerCruiseGallery($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\CruiseImages', 'er')
                ->where('er.cruiseId='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     
     public function cruiseimagesave($object) {

        $obj = $object['object'];

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\CruiseImages;

        $date = getdate();
        $entity->setCruiseId($obj['id']);
        $entity->setTitle($obj['title']);
        $entity->setImage($date[0] . '-' . $obj['image']);
        $entity->setAddedOn(new \DateTime);
        $em->persist($entity);
        $em->flush();

        $this->saveCruiseImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        return $event;
    }
    
    public function deleteCruiseImage($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('Base\Entity\Avp\CruiseImages', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }
    
    public function getResellerCruiseCabin($id){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\CruiseCabins', 'er')
                ->where('er.cruiseId='.$id);
               ;
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     
     public function deletecruise($id) {
        //d($id);
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $qb->delete('\Base\Entity\Avp\Cruises', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
    }
    
    public function getResellerTemplate(){
         $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Avp\Themes', 'er')
                ->where('er.isDeleted=0');
               
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     
     public function getEmails($pattern){
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\Affiliates', 'er')
                ->innerJoin('\Base\Entity\Avp\Users', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.userId = e.id')
                ->where('e.email LIKE :word')
                ->setParameter('word', '%'.$pattern.'%');
               
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
     }
     
     public function saveTemplate($object){
       $obj = $object['object'];

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\Themes;

        $date = getdate();
        $entity->setType($obj['type']);
        $entity->setTitle($obj['title']);
        $entity->setImage($date[0] . '-' . $obj['image']);
        $entity->setCreatedDate(new \DateTime);
        $entity->setModifiedDate(new \DateTime);
        $entity->setStatus('1');
        $entity->setIsDeleted('0');
        
        if($obj['type']==1){
            $entity->setCost($obj['cost']);
        }elseif($obj['type']==3){
            $entity->setUserId($obj['id']);
        }
        $em->persist($entity);
        $em->flush();
        
        $this->saveTemplateImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        
        return $entity;
     }
     
      public function suspendTheme($id) {
//        $obj = $object['object'];
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Themes', (int) $id);

        $entity->setStatus('0');
        $em->persist($entity);
        $em->flush();


        return true;
    }
      public function unsuspendTheme($id) {
//        $obj = $object['object'];
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Themes', (int) $id);

        $entity->setStatus('1');
        $em->persist($entity);
        $em->flush();


        return true;
    }
      public function deleteTheme($id) {
//        $obj = $object['object'];
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Themes', (int) $id);

        $entity->setIsDeleted('1');
        $em->persist($entity);
        $em->flush();


        return true;
    }
    
     public function getTemplateData($id) {
      $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\Themes', 'e')
                ->where('e.id='.$id);
               
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        $newcollection=array();
        
        $newcollection['title']=$collection['0']->getTitle();
        $newcollection['image']=$collection['0']->getImage();
        $newcollection['cost']=$collection['0']->getCost();
        if($collection['0']->getUserId()){
            $newcollection['id']=$collection['0']->getUserId()->getId();
            $newcollection['email']=$collection['0']->getUserId()->getFirstName()." - ".$collection['0']->getUserId()->getEmail();
        }
        $newcollection['type']=$collection['0']->getType();
        
//        d($newcollection);
        return $newcollection;    
        
     }
     
      public function editTemplate($object,$id) {
        $obj = $object['object'];
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Avp\Themes', (int) $id);

        $date = getdate();
        $entity->setType($obj['type']);
        $entity->setTitle($obj['title']);
        if($object['files']['image']['tmp_name']){
            $entity->setImage($date[0] . '-' . $obj['image']);
        }
        $entity->setModifiedDate(new \DateTime);
      if($obj['type']==1){
            $entity->setCost($obj['cost']);
        }elseif($obj['type']==3){
            $entity->setUserId($obj['id']);
        }
        
        $em->persist($entity);
        $em->flush();

        if($object['files']['image']['tmp_name']){
            $this->saveTemplateImages($object['files']['image']['tmp_name'], $date[0] . '-' . $obj['image']);
        }
        return true;
    }
    
    public function getTemplateUsers($id) {
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\AvpProfiles', 'e')
                ->where('e.themeId='.$id);
               
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
    }
}