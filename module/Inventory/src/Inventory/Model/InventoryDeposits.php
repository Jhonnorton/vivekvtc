<?php

namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class InventoryDeposits extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

             $inputFilter->add($factory->createInput(array(
                        'name' => 'eventId',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'resortId',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));
            
             $inputFilter->add($factory->createInput(array(
                        'name' => 'cruiseId',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));
             
            $inputFilter->add($factory->createInput(array(
                        'name' => 'type',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'linkedTo',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'is_deleted',
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
                                    'format' => 'Y-m-d H:i:s',
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
                                    'format' => 'Y-m-d H:i:s',
                                ),
                            ),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'created',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Date',
                                'options' => array(
                                    'format' => 'Y-m-d H:i:s',
                                ),
                            ),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'modified',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'Date',
                                'options' => array(
                                    'format' => 'Y-m-d H:i:s',
                                ),
                            ),
                        ),
            )));

        

            $inputFilter->add($factory->createInput(array(
                        'name' => 'amount',
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
                        'name' => 'depositName',
                        'required' => true,
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
    
    public function getCollection(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\InventoryDeposits', 'er')->where('er.isDeleted=0');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        
        return $collection;
    }
    
    public function depositsave($object) {
        $object = $object['object'];
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\InventoryDeposits;
//        $tourid = $this->getEntityManager()->getRepository('\Base\Entity\Tours')->findOneBy(array('id' => $object['tour_id']));
  //      $countryid = $this->getEntityManager()->getRepository('\Base\Entity\Countries')->findOneBy(array('id' => $object['countryId']));

        $entity->setlinkedTo($object['linkedTo']);
        $entity->settype($object['type']);
        $entity->setamount($object['amount']);
        $entity->setdepositName($object['depositName']);
        if($object['resortId']){
            $resortId=  implode(',', $object['resortId']);
        }
        if($object['linkedTo']==4){
            $entity->setresortId($resortId);
        }elseif($object['linkedTo']==5){
            $entity->seteventId($resortId);
        }elseif($object['linkedTo']==6){
            $entity->setcruiseId($resortId);
        }
        $entity->setdateFrom(new \DateTime($object['dateFrom']));
        $entity->setdateTo(new \DateTime($object['dateTo']));

        $entity->setcreated(new \DateTime);
        $entity->setmodified(new \DateTime);

        $em->persist($entity);
        $em->flush();
        // d('success');
        return true;
    }
    
     public function depositdelete($id) {
        $object = $object['object'];
        $em = $this->getEntityManager();
//        d($id);
        $entity = $em->find('\Base\Entity\InventoryDeposits',(int)$id);
        $entity->setisDeleted(1);
        $entity->setmodified(new \DateTime);
        $em->persist($entity);
        $em->flush();

        //  d('success');
        //return $event;
    }
    
    public function depositupdate($object) {
        $object = $object['object'];
        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\InventoryDeposits', (int) $object['id']);
        $entity->setlinkedTo($object['linkedTo']);
        $entity->settype($object['type']);
        $entity->setamount($object['amount']);
        $entity->setdepositName($object['depositName']);
        $resortId=  implode(',', $object['resortId']);
        if($object['linkedTo']==4){
            $entity->setresortId($resortId);
        }elseif($object['linkedTo']==5){
            $entity->seteventId($resortId);
        }elseif($object['linkedTo']==6){
            $entity->setcruiseId($resortId);
        }
        $entity->setdateFrom(new \DateTime($object['dateFrom']));
        $entity->setdateTo(new \DateTime($object['dateTo']));

        $entity->setmodified(new \DateTime);
        $em->persist($entity);
        $em->flush();

        //  d('success');
        return true;
    }
    
    public function getTypes($type=null,$typeId=null) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        
        if($type==4){
            $qb->select('er')->from('\Base\Entity\Avp\Resorts', 'er')->where('er.id='.$typeId);
        }elseif($type==5){
            $qb->select('er')->from('\Base\Entity\Avp\Events', 'er')->where('er.id='.$typeId);
        }elseif($type==6){
           $qb->select('er')->from('\Base\Entity\Avp\Cruises', 'er')->where('er.id='.$typeId);
        }
        
        $query = $qb->getQuery();
        $collection = $query->getResult();
//        d($collection[0]->getTitle());
        return $collection[0]->getTitle();
    }
}