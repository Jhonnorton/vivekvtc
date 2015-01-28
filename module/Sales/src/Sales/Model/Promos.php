<?php
namespace Sales\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\ServiceManager\ServiceLocatorInterface;

class Promos extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
    
    //echo 'hello'; die;
    
    
    protected $inputFilter;    
    protected $loadedModel;

    const LINKED_TO_ALL = 0;
    const LINKED_TO_RESORTS = 1;
    const LINKED_TO_EVENTS = 2;
    const LINKED_TO_CRUISES = 3;
    const LINKED_TO_RESORT_NAME = 4;
    const LINKED_TO_EVENT_CATEGORY = 5;
    const LINKED_TO_CRUISE_NAME = 6;
    const LINKED_TO_EVENT_NAME = 7;
    const LINKED_TO_ROOM_CATEGORY = 8;
    const LINKED_TO_EVENT_ROOM = 9;
    const LINKED_TO_CABIN_NAME = 10;

    private static $serviceManager;        
    public static function initServiceManager($serviceManager){        
        if ( self::$serviceManager == null ){			
            self::$serviceManager = $serviceManager;
        }
    }    
    public static function linkedTo(){     
        return array(        
            self::LINKED_TO_ALL => array(
                'name'       => 'All',
                'model'      => null,                
                'collection' => null,
                'linkedTo'=> array(  
                    'entity' => null,
                    'model' => null,
                    'collection' => null,
                ),
            ),
            self::LINKED_TO_RESORTS => array(
                'name'       => 'All Resorts',
                'model'      => null,                
                'collection' => null,
                'linkedTo'=> array(                    
                    'entity' => null,
                    'model' => null,
                    'collection' => null,
                ),
            ),
            self::LINKED_TO_EVENTS => array(
                'name'       => 'All Events',
                'model'      => null,                
                'collection' => null,
                'linkedTo'=> array(                    
                    'entity' => null,
                    'model' => null,
                    'collection' => null,
                ),
            ),
            self::LINKED_TO_CRUISES => array(
                'name'       => 'All Cruises',
                'model'      => null,                
                'collection' => null,
                'linkedTo'=> array(                    
                    'entity' => null,
                    'model' => null,
                    'collection' => null,
                ),
            ),            
            self::LINKED_TO_RESORT_NAME => array(                
                'name'       => 'Resort Name ',
                'model'      => self::$serviceManager ? self::$serviceManager->get('Resorts') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('Resorts')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\ResortPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('ResortPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('ResortPromo')->getCollection() : null,
                ),
            ),
            self::LINKED_TO_EVENT_CATEGORY => array(                
                'name'       => 'Event Category',
                'model'      => self::$serviceManager ? self::$serviceManager->get('EventCategories') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('EventCategories')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\EventCategoryPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('EventCategoryPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('EventCategoryPromo')->getCollection() : null,
                ),
            ),
            self::LINKED_TO_CRUISE_NAME => array(                
                'name'       => 'Cruise Name',
                'model'      => self::$serviceManager ? self::$serviceManager->get('Cruises') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('Cruises')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\CruisePromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('CruisePromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('CruisePromo')->getCollection() : null,
                ),
            ),            
            self::LINKED_TO_EVENT_NAME => array(                
                'name'       => 'Event Name',
                'model'      => self::$serviceManager ? self::$serviceManager->get('Events') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('Events')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\EventsPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('EventsPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('EventsPromo')->getCollection() : null,
                ),
            ),
            self::LINKED_TO_ROOM_CATEGORY => array(                
                'name'       => 'Room Category',
                'model'      => self::$serviceManager ? self::$serviceManager->get('InventoryHotels') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('InventoryHotels')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\RoomsPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('RoomsPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('RoomsPromo')->getCollection() : null,
                ),
            ),
            self::LINKED_TO_EVENT_ROOM => array(
                'name'       => 'Event Room',
                'model'      => self::$serviceManager ? self::$serviceManager->get('InventoryEvent') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('InventoryEvent')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\EventRoomsPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('EventRoomsPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('EventRoomsPromo')->getCollection() : null,
                ),
            ),
            self::LINKED_TO_CABIN_NAME => array(
                'name'       => 'Cabin Name',
                'model'      => self::$serviceManager ? self::$serviceManager->get('InventoryCruise') : null,                
                'collection' => self::$serviceManager ? self::$serviceManager->get('InventoryCruise')->getCollection() : null,
                'linkedTo'=> array(                    
                    'entity' => '\Base\Entity\CabinsPromo',
                    'model'  => self::$serviceManager ? self::$serviceManager->get('CabinsPromo') : null,                
                    'collection' => self::$serviceManager ? self::$serviceManager->get('CabinsPromo')->getCollection() : null,
                ),
            ),
        );
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter){
        
        throw new \Exception("Not used");
    }

    public function getInputFilter(){
        
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
        
        
        
      //  d('here');
    /*    
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name'     => 'promoNames',
                        'required' => true,
                        'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                                        array(
                                                'name'    => 'StringLength',
                                                'options' => array(
                                                                'encoding' => 'UTF-8',
                                                                'min'      => 2,
                                                                'max'      => 64,
                                                ),
                                        ),
                        ),
            )));     
            
            
            $inputFilter->add($factory->createInput(array(
					'name'     => 'name',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 2,
											'max'      => 255,
									),
							),
					),
			)));	
            
            $inputFilter->add($factory->createInput(array(
					'name'     => 'email',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'EmailAddress',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 5,
											'max'      => 255,
									),
							),
					),
			)));
            
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'numberAvailable',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),
            ))); 
            
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'linkedTo',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ), 
                        'validators' => array(
                                    array(
                                            'name' => 'Int',
                                            'options' => array(
                                                                'min' => 0,
                                                                'max' => 10,
                                            ),
                                    ),
                        ),

            )));

   /*         $inputFilter->add($factory->createInput(array(
                        'name'     => 'isActive',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),
            )));                        
*/
  /*          $inputFilter->add($factory->createInput(array(
                            'name'     => 'dateFrom',
                            'required' => false,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),
                            'validators' => array(
                                                array(
                                                    'name'    => 'Date',
                                                    'options' => array(
                                                                    'format' => 'Y-m-d',
                                                    ),
                                                ),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'dateTo',
                            'required' => false,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),
                            'validators' => array(
                                                array(
                                                    'name'    => 'Date',
                                                    'options' => array(
                                                                    'format' => 'Y-m-d',
                                                    ),
                                                ),
                            ),
            ))); 
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'discount',
                        'required' => true,
                        'validators' => array(
                                                array(
                                                    'name' => 'Float',
                                                    'options' => array(
                                                        'min' => 0,
                                                    ),
                                                ),
                        ),
            )));
            
   /*         $inputFilter->add($factory->createInput(array(
                        'name'     => 'image',
                        'required' => false,
                        'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                                        array(
                                                'name'    => 'StringLength',
                                                'options' => array(
                                                                'encoding' => 'UTF-8',                                                                
                                                                'max'      => 255,
                                                ),
                                        ),
                        ),
            ))); */
            
         /*   $inputFilter->add($factory->createInput(array(
                        'name'     => 'promoCode',
                        'required' => true,
                        'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                                        array(
                                                'name'    => 'StringLength',
                                                'options' => array(
                                                                'encoding' => 'UTF-8',                                                                
                                                                'min'      => 2,
                                                                'max'      => 32,
                                                ),
                                        ),
                        ),
            )));
            
            
            
            
            
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'discountType',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),
            )));            
            
            $this->inputFilter = $inputFilter;
        }
*/
       // return $this->inputFilter;
    }
        
    protected function newPromoLinkedObject($typeCode, \Base\Entity\InventoryPromo $promo, $id){        
        $object = NULL;
		$linkedTo = $this->linkedTo();
        switch((int)$typeCode){            
            case self::LINKED_TO_ALL:
            case self::LINKED_TO_RESORTS:
            case self::LINKED_TO_EVENTS:
            case self::LINKED_TO_CRUISES:
                $object = NULL;
                break;
            case self::LINKED_TO_CRUISE_NAME:
                $object = new \Base\Entity\CruisePromo();                    
                $object->setPromo($promo);                    
                $object->setCruiseId($id);                
                break;
            case self::LINKED_TO_RESORT_NAME:
                $object = new \Base\Entity\ResortPromo();
                $object->setPromo($promo);                    
                $object->setResortId($id);  
                break;
            case self::LINKED_TO_EVENT_CATEGORY:
                $object = new \Base\Entity\EventCategoryPromo();
                $object->setPromo($promo);                    
                $object->setEventCategoryId($id);                
                break;
            case self::LINKED_TO_EVENT_NAME:                 
                $object = new \Base\Entity\EventsPromo();
                $object->setPromo($promo);
                $object->setEventId($id);                 
                break;
            case self::LINKED_TO_ROOM_CATEGORY:
                $object = new \Base\Entity\RoomsPromo();
                $object->setPromo($promo);    
				                            
                $item = $linkedTo[self::LINKED_TO_ROOM_CATEGORY]['model']->getItem($id);
                $object->setRoom($item);  
                break;
            case self::LINKED_TO_EVENT_ROOM:
                $object = new \Base\Entity\EventRoomsPromo();
                $object->setPromo($promo);
                $item = $linkedTo[self::LINKED_TO_EVENT_ROOM]['model']->getItem($id);
                $object->setEventRoom($item); 
                break;
            case self::LINKED_TO_CABIN_NAME:
                $object = new \Base\Entity\CabinsPromo();
                $object->setPromo($promo);
                $item = $linkedTo[self::LINKED_TO_CABIN_NAME]['model']->getItem($id);
                $object->setCabin($item);  
                break;                 
        }
                
        return $object;        
    }
       
    public function saveObject($object, $data = null) {
        
      //  d('here');
        
   //  d($object);
        
        
        $em = $this->getEntityManager();

        $promo = new $this->_targetEntity;
        
        
        $promo->setPromoNames($object['promoNames']);
        //$promo->setPromoNames($object['promotype']);
        
        if(!empty($object['Name'])){
            
              $promo->setname($object['Name']);
        }
        if(!empty($object['Email'])){
              $promo->setemail($object['Email']);
        }
        
        
        $promo->setLinkedTo($object['linkedTo']);
        $promo->setDiscount($object['discount']);
                 
        $promo->setpromoType($object['promotype']);
        
        $promo->setDiscountType($object['discountType']);
        
        $promo->setvalidity($object['validity']);
        
        $promo->setIsActive($object['isActive']);
        
        if($object['validity']==1){
        
        $promo->setNumberAvailable($object['numberAvailable']);
        
        }
        $promo->setPromoCode($object['promoCode']);      
        
        $promo->setCreated(new \DateTime);
        $promo->setUpdated(new \DateTime);
                 
                // $promo->setCreated($data['type']);
                 
                 
        
        $promo->setDateFrom(new \DateTime($object['dateFrom']));
        $promo->setDateTo(new \DateTime($object['dateTo']));
        
        
        
        
       $promo=parent::save($promo);
       // $promo = parent::save($object);
        
        //d('here after save');
        if($data){              
            foreach ($data as $id){
                $object = $this->newPromoLinkedObject($promo->getLinkedTo(), $promo, $id);                
                parent::save($object);
            }            
        }
        
      //  d($object);
    }  
    
    protected function deleteLinkedObjects($promo){
        
        
        //d($promo);
               
        for($i = self::LINKED_TO_RESORT_NAME;$i<=self::LINKED_TO_CABIN_NAME;$i++){
            $linkedTo = self::linkedTo();
            
           // d($linkedTo);
            
            $entity = $linkedTo[$i]['linkedTo']['entity'];
            
          //  d($entity);
            
            $em = $this->getEntityManager();
            $query = $em->createQuery("DELETE FROM $entity e WHERE e.promo = :promo");        
            $query->setParameter('promo', $promo['id']);        
            $query->getResult();        
        }
    }
    
    public function updateObject($promo, $data = null) {                       
        
        
      //  d($promo);
        
        $this->deleteLinkedObjects($promo);
        
        $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\InventoryPromo', (int)$promo['id']);
        
        //d($entity);
        
       // d('here im in update object');
        
         $entity->setPromoNames($promo['promoNames']);
        //$promo->setPromoNames($object['promotype']);
        
         
         
        if($promo['promotype']==2){
            
            //echo 'die inside if';
            
           $entity->setname($promo['name']);
           $entity->setemail($promo['email']);
        }
        else{
            
            //echo 'else';
           $entity->setname(Null);
           $entity->setemail(Null);
        }
        
        //die;
        
        $entity->setLinkedTo($promo['linkedTo']);
        $entity->setDiscount($promo['discount']);
                 
        $entity->setpromoType($promo['promotype']);
        
        $entity->setDiscountType($promo['discountType']);
        
        $entity->setvalidity($promo['validity']);
        if($promo['validity']==1){
        
        $entity->setNumberAvailable($promo['numberAvailable']);
        
        }
        $entity->setPromoCode($promo['promoCode']);
        
        $entity->setIsActive($promo['isActive']);
        
      //  $promo->setCreated(new \DateTime);
        $entity->setUpdated(new \DateTime);
                 
                // $promo->setCreated($data['type']);
                 
                 
        
        $entity->setDateFrom(new \DateTime($promo['dateFrom']));
        $entity->setDateTo(new \DateTime($promo['dateTo']));
        
        
        
        
        $promo = parent::save($entity);                        
        if($data){              
            foreach ($data as $id){
                $object = $this->newPromoLinkedObject($promo->getLinkedTo(), $promo, $id);                
                parent::save($object);
            }            
        }        
    }
    
    protected function isValidPromoCode($form){
        if($this->checkItem(array('promoCode'=>$form->getData()->getPromoCode()))){
            $form->get('promoCode')->setMessages(array('This promo code already exists'));
            return false;
        }
        return true;                
    }
    
    public function isValidModel($form){                      
        
        return $this->isValidPromoCode($form);            
    }
    
    public function isValidModelOnEdit($form){
        
        if($this->checkItem(array(
            'id'=>$form->getData()->getId(),
            'promoNames'=>$form->getData()->getPromoNames(),
            'promoCode'=>$form->getData()->getPromoCode(),
            ))
	){            
            return true;
        }        
        return $this->isValidModel($form);	            
    }
    
    public function getCollection($page = false) {
        $collection = parent::getCollection($page);
        foreach ($collection as $object){
        	$linkedTo = self::linkedTo();            
            $object->setLinkedTo($linkedTo[$object->getLinkedTo()]['name']);
        }
        return $collection;
    } 
    
    public function getPromosLinkedTo(ServiceLocatorInterface $serviceManager, $typeCode = 0, $id1 = 0, $id2 = 0){
        self::initServiceManager($serviceManager);
        /*        
        switch((int)$typeCode){            
            case self::LINKED_TO_ALL:
            
            case self::LINKED_TO_EVENTS:
            case self::LINKED_TO_CRUISES:
                $object = NULL;
                break;
            case self::LINKED_TO_RESORT_NAME:
                $item = self::getPromoRoomCategoty($id2);
                if($item) return $item;                   
            case self::LINKED_TO_RESORTS:
                
                
                
                
            case self::LINKED_TO_CRUISE_NAME:
                $object = new \Base\Entity\CruisePromo();                    
                $object->setPromo($promo);                    
                $object->setCruiseId($id);                
                break;
            
            case self::LINKED_TO_EVENT_CATEGORY:
                $object = new \Base\Entity\EventCategoryPromo();
                $object->setPromo($promo);                    
                $object->setEventCategoryId($id);                
                break;
            case self::LINKED_TO_EVENT_NAME:                 
                $object = new \Base\Entity\EventsPromo();
                $object->setPromo($promo);
                $object->setEventId($id);                 
                break;
            case self::LINKED_TO_ROOM_CATEGORY:
                $object = new \Base\Entity\RoomsPromo();
                $object->setPromo($promo);                                
                $item = $this->linkedTo()[self::LINKED_TO_ROOM_CATEGORY]['model']->getItem($id);
                $object->setRoom($item);  
                break;
            case self::LINKED_TO_EVENT_ROOM:
                $object = new \Base\Entity\EventRoomsPromo();
                $object->setPromo($promo);
                $item = $this->linkedTo()[self::LINKED_TO_EVENT_ROOM]['model']->getItem($id);
                $object->setEventRoom($item); 
                break;
            case self::LINKED_TO_CABIN_NAME:
                $object = new \Base\Entity\CabinsPromo();
                $object->setPromo($promo);
                $item = $this->linkedTo()[self::LINKED_TO_CABIN_NAME]['model']->getItem($id);
                $object->setCabin($item);  
                break;                 
        }          
        */       
    }    
    
    public static function getPromoRoomCategoty($id){
    	$linkedTo = self::linkedTo();
        $model = $linkedTo[self::LINKED_TO_EVENT_ROOM]['model'];        
        if($model){
            $room = $model->getItemBy(array('id'=>$id));            
            if($room){                
                $em = self::$serviceManager->get('Doctrine\ORM\EntityManager');                
                $qb = $em->createQueryBuilder();                        
                $qb->select(array('ih'))
                    ->from('\Base\Entity\InventoryPromo', 'ih') 
                    //->innerJoin('\Base\Entity\RoomsPromo', 'rp', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rp.room = cr.id')                
                    ->where('ih.id=:id')
                    ->andWhere('ih.dateFrom <= :dateFrom')
                    ->andWhere('ih.dateTo >= :dateTo')
                    ->setParameter('id', $id)
                    ->setParameter('dateFrom', $date->format('Y-m-d'))
                    ->setParameter('dateTo', $date->format('Y-m-d'))
                    ->setMaxResults(1);                        
                        $query = $qb->getQuery();
                                                
                return $model->getItemBy(array('room'=>$room), true);                 
            }
            return null;
        } 
        return null;
    }
    
    public static function getPromoEventRoom($id){
        $linkedTo = self::linkedTo();
        $model = $linkedTo[self::LINKED_TO_EVENT_ROOM]['model'];
        if($model){
            $room = $model->getItemBy(array('id'=>$id));            
            if($room){
                $model = $linkedTo[self::LINKED_TO_EVENT_ROOM]['linkedTo']['model'];
                return $model->getItemBy(array('eventRoom'=>$room), true);                 
            }
            return null;
        } 
        return null;
    }
    
    public static function getPromoCabinName($id){
        $linkedTo = self::linkedTo();
        $model = $linkedTo[self::LINKED_TO_CABIN_NAME]['model'];
        if($model){
            $cabin = $model->getItemBy(array('id'=>$id));            
            if($cabin){
                $model = $linkedTo[self::LINKED_TO_CABIN_NAME]['linkedTo']['model'];
                return $model->getItemBy(array('cabin'=>$cabin), true);                 
            }
            return null;
        } 
        return null;
    }
    
    public static function getPromoResort($id){
        $linkedTo = self::linkedTo();
        $model = $linkedTo[self::LINKED_TO_RESORTS]['model'];
        if($model){
            $cabin = $model->getItemBy(array('resortId'=>$id));            
            if($cabin){
                $model = $linkedTo[self::LINKED_TO_CABIN_NAME]['linkedTo']['model'];
                return $model->getItemBy(array('cabin'=>$cabin), true);                 
            }
            return null;
        } 
        return null;
    }
} 