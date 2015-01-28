<?php

namespace Accounts\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;

class Accounts extends \Base\Model\BaseModel implements InputFilterAwareInterface {

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




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function isValidModel($form) {

        return true;
    }

   public function getCollection($acttype=null,$page = false){
    	
        //d($this->_repository->findAll());
        $rate=0.00;
        if($acttype){
            $accounttype=$acttype;
            
        }else{        
        $accounttype=0;
        }
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Users', 'ih')
            ->where('ih.accountType = :atype')
            ->setParameter('atype',$accounttype)
            ->andWhere('ih.rate!= :rate')
            ->setParameter('rate',$rate);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        //d($collection);
        if(!$page) return $collection;//$this->_repository->findBy(array('accountType'=>0,"rate!=:$rate"));
        
        $adapter = new DoctrineAdapter(new ORMPaginator($this->_repository->createQueryBuilder('page')));
        return new Paginator($adapter);
        
    }
    
    public function save($object){
		
            parent::save($object);
		
	}
        
    public function getItemView($id) {

        return $this->_repository->findOneBy(array('id'=>$id));
        
        
    }
    
  

}