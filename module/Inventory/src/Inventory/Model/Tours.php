<?php

namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Tours extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb

    public function getImagePath() {
        return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'resort/thumbnails_80x80/';
    }

    protected $_imageOptions = array(
        //img 80x80
        array(
            'options' => array('width' => 80, 'height' => 80),
            'destination' => 'resort/thumbnails_80x80/'
        ),
        //img 91x65
        array(
            'options' => array('width' => 91, 'height' => 65),
            'destination' => 'resort/thumbnails_91x65'
        ),
        //img 150x150
        array(
            'options' => array('width' => 150, 'height' => 150),
            'destination' => 'resort/thumbnails_150x150/'
        ),
        //img 158x106
        array(
            'options' => array('width' => 158, 'height' => 106),
            'destination' => 'resort/thumbnails_158x106/'
        ),
        //img 202x144
        array(
            'options' => array('width' => 202, 'height' => 144),
            'destination' => 'resort/thumbnails_202x144/'
        ),
        //img 288x196
        array(
            'options' => array('width' => 288, 'height' => 196),
            'destination' => 'resort/thumbnails_288x196/'
        ),
        //img 288x161
        array(
            'options' => array('width' => 288, 'height' => 161),
            'destination' => 'resort/thumbnails_288x161/'
        ),
        //img 957x381
        array(
            'options' => array('width' => 957, 'height' => 381),
            'destination' => 'resort/slider_957x381/'
        ),
        //img 701x456
        array(
            'options' => array('width' => 701, 'height' => 456),
            'destination' => 'resort/slider_701x456/'
        ),
        //img small 250x250
        array(
            'options' => array('width' => 250, 'height' => 250),
            'destination' => 'resort/small/'
        ),
        //img large 800x600
        array(
            'options' => array('width' => 800, 'height' => 600),
            'destination' => 'resort/large/'
        ),
        //img
        array(
            'options' => null,
            'destination' => 'resort/'
        )
    );

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'eventId',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));
            /*
              $inputFilter->add($factory->createInput(array(
              'name'     => 'roomId',
              'required' => true,
              'filters'  => array(
              array('name' => 'Int'),
              ),

              )));
             */
            $inputFilter->add($factory->createInput(array(
                        'name' => 'totalAvailable',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'dateFrom',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Date',
                                'options' => array(
                                    'format' => 'Y-m-d',
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'dateTo',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Date',
                                'options' => array(
                                    'format' => 'Y-m-d',
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'netPrice',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Float',
                                'options' => array(
                                    'min' => 0,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'grossPrice',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Float',
                                'options' => array(
                                    'min' => 0,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'promo',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
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

    protected function saveImages($tmpName, $imgName) {
        foreach ($this->_imageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }

    protected function deleteImages($imageName) {
        foreach ($this->_imageOptions as $imgOption) {
            $file = \Base\Model\Plugins\Imagine::$srcDestination . $imgOption['destination'] . $imageName;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function getCollection($page = false) {

        //d('here');
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Tours', 'er')->where('er.isDeleted=0');
        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'tour' => $item,
                'locations' => $this->_getTourLocations($item->getId()),
                'locationcount' => count($this->_getTourLocations($item->getId())),
                'resorts' => $this->_getTourResorts($item->getId()),
                'resortcount' => count($this->_getTourResorts($item->getId())),
                'resortrooms' => $this->_getTourResortRooms($item->getId()),
                'resortroomscount' => count($this->_getTourResortRooms($item->getId())),
            );
        }
        return $newCollection;
        // d($newCollection[1]['tour']->getTitle());
    }

    protected function _getTourLocations($tourId) {
        //d($tourId);

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\TourLocations')->findBy(array('tourId' => $tourId, 'isDeleted' => '0'), array('id' => 'ASC'));

        // d($collection);

        return $collection;
    }

    protected function _getTourResorts($tourId) {
        //d($tourId);

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\TourResorts')->findBy(array('tourId' => $tourId, 'isDeleted' => '0'));

        // d($collection);

        return $collection;
    }

    protected function _getTourResortRooms($tourId) {
        //d($tourId);

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\InventoryTourRooms')->findBy(array('tourId' => $tourId, 'isDeleted' => '0'));

        // d($collection);

        return $collection;
    }

    public function getLocationView($id) {

        $collection = $this->getCollection();
        //d($collection[$id]['locations']);
        return $collection[$id]['locations'];
    }

    public function locationsave($object) {
        $object = $object['object'];
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\TourLocations;
        $tourid = $this->getEntityManager()->getRepository('\Base\Entity\Tours')->findOneBy(array('id' => $object['tour_id']));
        $countryid = $this->getEntityManager()->getRepository('\Base\Entity\Countries')->findOneBy(array('id' => $object['countryId']));

        $entity->setTourId($tourid);
        $entity->setCountryId($countryid);
        $entity->setCity($object['city']);

        $entity->setFromDate(new \DateTime($object['fromDate']));
        $entity->setToDate(new \DateTime($object['toDate']));

        $entity->setCreated(new \DateTime);
        $entity->setModified(new \DateTime);

        $em->persist($entity);
        $em->flush();
        // d('success');
        return true;
    }

    public function locationupdate($object) {
        $object = $object['object'];
        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\TourLocations', (int) $object['id']);
        if ($object['countryId']) {
            $countryid = $this->getEntityManager()->getRepository('\Base\Entity\Countries')->findOneBy(array('id' => $object['countryId']));
            $entity->setCountryId($countryid);
        }
        $entity->setCity($object['city']);

        $entity->setFromDate(new \DateTime($object['fromDate']));
        $entity->setToDate(new \DateTime($object['toDate']));
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();

        //  d('success');
        //return $event;
    }

    public function locationdelete($id) {
        $object = $object['object'];
        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\TourLocations', (int) $id);
        $entity->setIsDeleted(1);
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();

        //  d('success');
        //return $event;
    }

    public function getLocationResorts($locationId) {
        //   d($locationId);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\TourResorts')->findBy(array('locationId' => $locationId, 'isDeleted' => '0'));
        //d($collection);
        return $collection;
    }

    public function resortsave($object) {
        $obj = $object['object'];
        //d($obj);
        $em = $this->getEntityManager();

        $tourid = $this->getEntityManager()->getRepository('\Base\Entity\Tours')->findOneBy(array('id' => $obj['tourId']));
        $locationid = $this->getEntityManager()->getRepository('\Base\Entity\TourLocations')->findOneBy(array('id' => $obj['locationId']));

        if ($obj['type'] == 1) {

            $entity = new \Base\Entity\TourResorts;
            $resortid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $obj['resortId']));

            $entity->setTourId($tourid);
            $entity->setLocationId($locationid);
            $entity->setResortId($resortid);
            $entity->setFromDate(new \DateTime($obj['fromDate']));
            $entity->setToDate(new \DateTime($obj['toDate']));

            $entity->setCreated(new \DateTime);
            $entity->setModified(new \DateTime);
            $em->persist($entity);
            $em->flush();
        } else {

            // d($obj);
            $entity = new \Base\Entity\Avp\Resorts;
            $entity->setTitle($obj['title']);
            $entity->setRatingId($obj['rating']);
            $entity->setOverview($obj['overview']);
            $date = getdate();
            $entity->setImage($date[0] . '-' . $obj['image']);
            if ($obj['vp']) {
                $entity->setAddedToVp($obj['vp']);
                //   d('here');
            } else {
                $entity->setAddedToVp(0);
            }
            $entity->setIsTour(1);

            // $entity->setImage($obj['image']);

            $entity->setAddedOn(new \DateTime);

            $em->persist($entity);
            $em->flush();

            // d($entity);


            $entity1 = new \Base\Entity\TourResorts;
            $resortid = $entity;
            $entity1->setTourId($tourid);
            $entity1->setLocationId($locationid);
            $entity1->setResortId($resortid);
            $entity1->setFromDate(new \DateTime($obj['fromDate']));
            $entity1->setToDate(new \DateTime($obj['toDate']));

            $entity1->setCreated(new \DateTime);
            $entity1->setModified(new \DateTime);
            $em->persist($entity1);
            $em->flush();
        }

        return true;
    }

    public function resortdelete($id) {
        $object = $object['object'];
        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\TourResorts', (int) $id);
        $entity->setIsDeleted(1);
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
    }

    public function setresortactive($id) {
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\TourResorts', (int) $id);
        $entity->setStatus(1);
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
        return;
    }

    public function setresortinactive($id) {
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\TourResorts', (int) $id);

        $entity->setStatus('0');
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
        return;
    }

    public function getLocationResortRooms($locationId, $resortId) {
        //   d($locationId);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\InventoryTourRooms')->findBy(array('resortId' => $resortId, 'locationId' => $locationId, 'isDeleted' => '0'));
        //d($collection);
        return $collection;
    }

    public function getroom($resortId) {
        //   d($data);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findBy(array('resortId' => $resortId));
        // d($collection);
        return $collection;
    }

    public function resortroomsave($object) {
        $obj = $object['object'];
        // d($obj);
        $em = $this->getEntityManager();

        // $tourid = $this->getEntityManager()->getRepository('\Base\Entity\Tours')->findOneBy(array('id' => $obj['tourId']));
        $locationid = $this->getEntityManager()->getRepository('\Base\Entity\TourLocations')->findOneBy(array('id' => $obj['locationId']));
        $tourid = $locationid->getTourId();
        //d($tourid);
        $resortid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $obj['resortId']));

        if ($obj['type'] == 1) {

            $entity = new \Base\Entity\InventoryTourRooms;
            $roomid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $obj['roomId']));

            $entity->setTourId($tourid);
            $entity->setLocationId($locationid);
            $entity->setResortId($resortid);
            $entity->setRoomId($roomid);




            $entity->setNetPrice($obj['netPrice']);

            $entity->setGrossPrice($obj['grossPrice']);
            $entity->setBoard($obj['board']);
            $entity->setDoubleOccupancyRate($obj['doubleOccupancyRate']);
            $entity->setPricePer($obj['pricePer']);
            $entity->setFemalesCount($obj['femalesCount']);
            $entity->setMalesCount($obj['malesCount']);


            $entity->setTripleOccupancyAllowed($obj['tripleOccupancyAllowed']);
            $entity->setTriplePriceFemaleNet($obj['triplePriceFemaleNet']);
            $entity->setTriplePriceFemaleGross($obj['triplePriceFemaleGross']);
            $entity->setTriplePriceMaleNet($obj['triplePriceMaleNet']);
            $entity->setTriplePriceMaleGross($obj['triplePriceMaleGross']);

            if ($obj['tripleFemaleNa']) {
                $entity->setTripleFemaleNa($obj['tripleFemaleNa']);
            } else {
                $entity->setTripleFemaleNa(0);
            }
            if ($obj['tripleMaleNa']) {
                $entity->setTripleMaleNa($obj['tripleMaleNa']);
            } else {
                $entity->setTripleMaleNa(0);
            }


            $entity->setQuadOccupancy($obj['quadOccupancy']);
            $entity->setSinglePremiumOccupancy($obj['singlePremiumOccupancy']);
            $entity->setSinglePriceNet($obj['singlePriceNet']);
            $entity->setSinglePriceGross($obj['singlePriceGross']);
            $entity->setSingleShare($obj['singleShare']);


            $entity->setCreated(new \DateTime);
            $entity->setModified(new \DateTime);
            $em->persist($entity);
            $em->flush();

            // d('success');
        } else {

            //d($obj);
            $entity = new \Base\Entity\Avp\ResortRooms;
            $entity->setTitle($obj['title']);
            $entity->setDescription($obj['description']);
            $date = getdate();
            $entity->setImage($date[0] . '-' . $obj['image']);
            $entity->setResortId($obj['resortId']);
            $entity->setInStock(0);
            $em->persist($entity);
            $em->flush();

            // d($entity);


            $entity1 = new \Base\Entity\InventoryTourRooms;
            $roomid = $entity;
            $entity1->setTourId($tourid);
            $entity1->setLocationId($locationid);
            $entity1->setResortId($resortid);
            $entity1->setRoomId($roomid);




            $entity1->setNetPrice($obj['netPrice']);

            $entity1->setGrossPrice($obj['grossPrice']);
            $entity1->setBoard($obj['board']);
            $entity1->setDoubleOccupancyRate($obj['doubleOccupancyRate']);
            $entity1->setPricePer($obj['pricePer']);
            $entity1->setFemalesCount($obj['femalesCount']);
            $entity1->setMalesCount($obj['malesCount']);


            $entity1->setTripleOccupancyAllowed($obj['tripleOccupancyAllowed']);
            $entity1->setTriplePriceFemaleNet($obj['triplePriceFemaleNet']);
            $entity1->setTriplePriceFemaleGross($obj['triplePriceFemaleGross']);
            $entity1->setTriplePriceMaleNet($obj['triplePriceMaleNet']);
            $entity1->setTriplePriceMaleGross($obj['triplePriceMaleGross']);


            if ($obj['tripleFemaleNa']) {
                $entity1->setTripleFemaleNa($obj['tripleFemaleNa']);
            } else {
                $entity1->setTripleFemaleNa(0);
            }
            if ($obj['tripleMaleNa']) {
                $entity1->setTripleMaleNa($obj['tripleMaleNa']);
            } else {
                $entity1->setTripleMaleNa(0);
            }



            $entity1->setQuadOccupancy($obj['quadOccupancy']);
            $entity1->setSinglePremiumOccupancy($obj['singlePremiumOccupancy']);
            $entity1->setSinglePriceNet($obj['singlePriceNet']);
            $entity1->setSinglePriceGross($obj['singlePriceGross']);
            $entity1->setSingleShare($obj['singleShare']);


            $entity1->setCreated(new \DateTime);
            $entity1->setModified(new \DateTime);
            $em->persist($entity1);
            $em->flush();

            // d('everything saved');
        }

        return true;
    }

    public function resortroomupdate($object) {
        $obj = $object['object'];
        $em = $this->getEntityManager();

        $entity1 = $em->find('\Base\Entity\InventoryTourRooms', (int) $obj['id']);
        // d($entity1);
        $entity1->setNetPrice($obj['netPrice']);

        $entity1->setGrossPrice($obj['grossPrice']);
        $entity1->setBoard($obj['board']);
        $entity1->setDoubleOccupancyRate($obj['doubleOccupancyRate']);
        $entity1->setPricePer($obj['pricePer']);
        $entity1->setFemalesCount($obj['femalesCount']);
        $entity1->setMalesCount($obj['malesCount']);


        $entity1->setTripleOccupancyAllowed($obj['tripleOccupancyAllowed']);
        $entity1->setTriplePriceFemaleNet($obj['triplePriceFemaleNet']);
        $entity1->setTriplePriceFemaleGross($obj['triplePriceFemaleGross']);
        $entity1->setTriplePriceMaleNet($obj['triplePriceMaleNet']);
        $entity1->setTriplePriceMaleGross($obj['triplePriceMaleGross']);

        if ($obj['tripleFemaleNa']) {
            $entity1->setTripleFemaleNa($obj['tripleFemaleNa']);
        } else {
            $entity1->setTripleFemaleNa(0);
        }
        if ($obj['tripleMaleNa']) {
            $entity1->setTripleMaleNa($obj['tripleMaleNa']);
        } else {
            $entity1->setTripleMaleNa(0);
        }


        $entity1->setQuadOccupancy($obj['quadOccupancy']);
        $entity1->setSinglePremiumOccupancy($obj['singlePremiumOccupancy']);
        $entity1->setSinglePriceNet($obj['singlePriceNet']);
        $entity1->setSinglePriceGross($obj['singlePriceGross']);
        $entity1->setSingleShare($obj['singleShare']);

        $entity1->setModified(new \DateTime);
        $em->persist($entity1);
        $em->flush();
    }

    public function resortroomdelete($id) {

        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\InventoryTourRooms', (int) $id);
        $entity->setIsDeleted(1);
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
    }

    public function setresortroomactive($id) {
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\InventoryTourRooms', (int) $id);
        $entity->setStatus(1);
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
        return;
    }

    public function setresortroominactive($id) {
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\InventoryTourRooms', (int) $id);

        $entity->setStatus('0');
        $entity->setModified(new \DateTime);
        $em->persist($entity);
        $em->flush();
        return;
    }

}