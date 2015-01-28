<?php

namespace Reports\Model;


use Reports\Controller\ReportsController;

class ReportsAjaxModel extends \Base\Model\BaseModel {

    
      public function getallCollection($type,$source=null){
          
      if($type==1){
          if($source != 'reseller'){
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findAll();
          }else{
             $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('isDeleted'=>0,'status'=>1));
          }
      }elseif($type==2){
          if($source != 'reseller'){
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findAll();
          }else{
              $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('isDeleted'=>0,'status'=>1,'approved'=>1));
          }
      }elseif($type==3){
       if($source != 'reseller'){
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findAll();
          }else{
             $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('isDeleted'=>0,'status'=>1));
          }  
      }elseif($type==4){
       $collection = $this->getEntityManager()->getRepository('\Base\Entity\InventoryItem')->findAll();       
      }elseif($type==5){
       $collection = $this->getEntityManager()->getRepository('\Base\Entity\InventoryExcursion')->findAll();       
      }elseif($type==6){
       $collection = $this->getEntityManager()->getRepository('\Base\Entity\InventoryTransfer')->findAll();       
      }
      return  $collection;
      }
      
      public function getallUsers($role){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Users', 'er')->where('er.role='.$role);

        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection; 
      }

}