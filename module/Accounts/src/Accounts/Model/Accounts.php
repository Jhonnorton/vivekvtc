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
//        $user = $em->find('Base\Entity\Users', 6);
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Users', 'ih')
            ->where('ih.accountType = :atype')
            ->setParameter('atype',$accounttype)
            ->andWhere('ih.rate!= :rate')
            ->setParameter('rate',$rate);
//            ->where('ih.role = 6 OR ih.role = 7');
        
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        //d($collection);
        if(!$page) return $collection;//$this->_repository->findBy(array('accountType'=>0,"rate!=:$rate"));
        
        $adapter = new DoctrineAdapter(new ORMPaginator($this->_repository->createQueryBuilder('page')));
        return new Paginator($adapter);
        
    }
   public function getCommissionCollection($acttype=null,$page = false){
    	
        //d($this->_repository->findAll());
//        $rate=0.00;
//        if($acttype){
//            $accounttype=$acttype;
//            
//        }else{        
//        $accounttype=0;
//        }
        $em = $this->getEntityManager();
//        $user = $em->find('Base\Entity\Users', 6);
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Users', 'ih')
            //->where('ih.accountType = :atype')
            //->setParameter('atype',$accounttype)
//            ->andWhere('ih.rate!= :rate')
//            ->setParameter('rate',$rate)
            ->where('ih.role = 6 OR ih.role = 7');
        
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        $newcollection=array();
        foreach($collection as $row){
            $newcollection[]=array(
                'collection'=>$row,
                'earned'=>$this->getCommissionEarned($row->getId())
                    );
        }
        
        //d($newcollection);
        return $newcollection;
        //d($collection);
//        if(!$page) return $collection;//$this->_repository->findBy(array('accountType'=>0,"rate!=:$rate"));
//        
//        $adapter = new DoctrineAdapter(new ORMPaginator($this->_repository->createQueryBuilder('page')));
//        return new Paginator($adapter);
        
    }
    
    public function save($object){
		
            parent::save($object);
		
	}
        
    public function getItemView($id) {

        return $this->_repository->findOneBy(array('id'=>$id));
        
        
    }
    
    public function getRoleCollection(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\AgentCommissions', 'ih')
            ->where("ih.isDeleted=0 AND ih.userId is NULL");
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
    public function getAddRoleCollection(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Role', 'ih')
            ->where("ih.name LIKE '%Reseller%' OR ih.name LIKE '%Reservation%'");
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
    public function getReservationActivity(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Resource', 'ih')
            ->where("ih.module=1");
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
    public function getUserData($userid){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Users', 'ih')
            ->where("ih.id=".$userid);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
    public function getUserCommission($userid){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\AgentCommissions', 'ih')
            ->where("ih.userId=".$userid." AND ih.isDeleted=0");
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
    public function getResellerActivity(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Resource', 'ih')
            ->where("ih.module=10");
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
  public function getBonusCollection(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Bonus', 'ih');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  public function getAllUsers(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Users', 'ih');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }

  public function saveBonus($data){
        $em = $this->getEntityManager();
        $user = $em->find('Base\Entity\Users', (int)$data['user']);
        
        $entity = new \Base\Entity\Bonus;

        $entity->setAmount($data['amount']);
        $entity->setType($data['type']);
        $entity->setUserId($user);
        $entity->setStatus('0');
        $entity->setCreated(new \DateTime);
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  public function saveRoleCommission($data){
        $i=0;
        foreach($data['type'] as $type){
            if($type!=''){
                $em = $this->getEntityManager();
                $role = $em->find('Base\Entity\Role', (int)$data['role']);
                $entity = new \Base\Entity\AgentCommissions;

                $activity = $em->find('Base\Entity\Resource', (int)$data['activity'][$i]);
                $entity->setRoleId($role);
                $entity->setResourceId($activity);
                $entity->setAmount($data['amount'][$i]);
                $entity->setCommissionType($type);
                $entity->setIsDeleted('0');
                $entity->setCreated(new \DateTime);
                $entity->setUpdated(new \DateTime);
                $em->persist($entity);
                $em->flush();
            }
            $i++;
        }
  }
  public function saveUserCommission($data){
        $i=0;
        foreach($data['type'] as $type){
            if($type!=''){
                $em = $this->getEntityManager();
                $role = $em->find('Base\Entity\Role', (int)$data['role']);
                $entity = new \Base\Entity\AgentCommissions;

                $activity = $em->find('Base\Entity\Resource', (int)$data['activity'][$i]);
                $user = $em->find('Base\Entity\Users', (int)$data['user']);
                $entity->setRoleId($role);
                $entity->setResourceId($activity);
                $entity->setUserId($user);
                $entity->setAmount($data['amount'][$i]);
                $entity->setCommissionType($type);
                $entity->setIsDeleted('0');
                $entity->setCreated(new \DateTime);
                $entity->setUpdated(new \DateTime);
                $em->persist($entity);
                $em->flush();
            }
            $i++;
        }
  }
  public function saveRoleCommissionUpdate($data){
//        d($data);
        $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\AgentCommissions', (int)$data['id']);
        $entity->setAmount($data['amount']);
        $entity->setCommissionType($data['type']);
        $entity->setUpdated(new \DateTime);
        $em->persist($entity);
        $em->flush();
            
  }
  
  public function deleteRoleCommission($id){
       $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\AgentCommissions', (int)$id);
        $entity->setIsDeleted('1');
        $entity->setUpdated(new \DateTime);
        $em->persist($entity);
        $em->flush();
        
        return $entity;
  }
  
   public function getRoleCommissionData($id){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('Base\Entity\AgentCommissions', 'ih')
                ->where('ih.id='.$id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
   public function getBonusData($id){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Bonus', 'ih')
                ->where('ih.id='.$id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
  public function editBonus($data){
        $em = $this->getEntityManager();
        $user = $em->find('Base\Entity\Users', (int)$data['user']);
        
        $entity =$em->find('Base\Entity\Bonus', (int)$data['id']);

        $entity->setAmount($data['amount']);
        $entity->setType($data['type']);
        $entity->setUserId($user);
        $entity->setStatus($data['status']);
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  public function applyBonus($id){
        $em = $this->getEntityManager();
        $entity =$em->find('Base\Entity\Bonus', (int)$id);

        $entity->setStatus('1');
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  public function revertBonus($id){
        $em = $this->getEntityManager();
        $entity =$em->find('Base\Entity\Bonus', (int)$id);

        $entity->setStatus('0');
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  
   public function deleteBonus($id){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->delete('\Base\Entity\Bonus', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
  }
  
   public function getExpenseCollection(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Expense', 'ih');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
  public function saveExpense($data){
        $em = $this->getEntityManager();
        $expense = $em->find('Base\Entity\ExpenseCategory', (int)$data['category']);
        
        $entity = new \Base\Entity\Expense;

        $entity->setAmount($data['amount']);
        $entity->setName($data['name']);
        $entity->setExpenseCategoryId($expense);
        $entity->setCreated(new \DateTime);
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  public function saveExpenseCategory($data){
        $em = $this->getEntityManager();
//        $user = $em->find('Base\Entity\ExpenseCategory', (int)$data['category']);
        
        $entity = new \Base\Entity\ExpenseCategory;

        $entity->setName($data['name']);

        $em->persist($entity);
        $em->flush();
  }
  
  public function getExpenseCategories(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\ExpenseCategory', 'ih');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
  public function getExpenseData($id){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Expense', 'ih')
                ->where('ih.id='.$id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
  }
  
  public function editExpense($data){
        $em = $this->getEntityManager();
        $category = $em->find('Base\Entity\ExpenseCategory', (int)$data['category']);
        
        $entity =$em->find('Base\Entity\Expense', (int)$data['id']);

        $entity->setAmount($data['amount']);
        $entity->setName($data['name']);
        $entity->setExpenseCategoryId($category);
        $entity->setUpdated(new \DateTime);

        $em->persist($entity);
        $em->flush();
  }
  
  public function deleteExpense($id){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->delete('\Base\Entity\Expense', 'u')
                ->where('u.id=:Id')
                ->setParameter('Id', $id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
  }
  
   public function getExpenseSearch($data){
       if(!empty($data['from']) && !empty($data['to'])){
           $where="ih.created>='".$data['from']."' AND ih.created<='".$data['to']."'";
       }elseif(!empty($data['from'])){
           $where="ih.created>='".$data['from']."'";
       }elseif(!empty($data['to'])){
           $where="ih.created<='".$data['to']."'";
       }else{
           $where='';
       }
//       d($where);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\Expense', 'ih')
                ->where($where);
        $query = $qb->getQuery();
        $collection = $query->getResult();
//        d($collection);
        return $collection;
  }
  
  
  public function getCommissionEarned($userid){
       $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\AgentCommissionEarned', 'ih')
                ->where('ih.userId='.$userid);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        $totalamt=0;
        foreach($collection as $row){
            $totalamt+=$row->getAmount();
        }
        return $totalamt;
  }

}