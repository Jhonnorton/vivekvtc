<?php

namespace Orders\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Invoices extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();
	
			
			
			
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	public function isValidModel($form){
            
		return true;
	}	
        
    /*    public function getCollection($page = false) {
                        
            return parent::getCollection($page);



        }
*/

      public function getCollection($page = false) {

        //return array();
        $collection =  parent::getCollection($page);
        
        $newCollection = array();
        foreach ($collection as $item){
            //d($item->getId());
           $newCollection[$item->getId()] = array(
               'id'  => $item->getId(),
	       'dateadded'=>$item->getDateAdded(),
	        'orderid'=>$item->getOrderId(), // /*,
		
		'amountpaid'=>$item->getAmountPaid(),
	        'travellers' => $this->_getTravellers($item->getOrderId()),
//	*/
           ); 
            
        }
        
        return $newCollection;
    }


     public function getItemView($id){
        
      //  $collection = $this->getCollection();
        
      //  return $collection[$id];


	$em = $this->getEntityManager();
        $travellers = array();
	$em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
/*	$qb->select(array(
            'c.id AS id',                        
            'c.transactionId AS transactionIds',
	    'c.amountPaid AS amountpaid',
	    'c.paymentMode AS paymentMode',
	    'c.dateAdded AS dateAdded',
	    'c.currencyCode AS currencyCode',
	    'c.orderId AS orderId',


            ))->from('\Base\Entity\Avp\OrderInvoices', 'c')
            ->where('c.id = :id')
            ->setParameter('id', (int)$id);   
*/




	  $qb->select(array(

	    'r.name AS clientName',
	    'r.email AS clientemail',
            'e.id AS deckid',
	    'e.amountTotal AS totalamount',
	    'e.amountDue AS amountDue',
	    'e.depositAmount AS depositAmount',
	    'e.travelDateFrom AS travelDateFrom',
	    'e.travelDateTo AS travelDateTo',
	   
	    'er.id AS inid',
	    'er.transactionId AS transactionIds',
	    'er.amountPaid AS amountpaid',
	    'er.paymentMode AS paymentMode',
	    'er.dateAdded AS dateAdded',
	    'er.currencyCode AS currencyCode'
  
            ))->from('\Base\Entity\Avp\OrderInvoices', 'er')
            ->innerJoin('\Base\Entity\Avp\Orders', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')            
            ->innerJoin('\Base\Entity\Avp\Clients', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'e.clientId = r.id')            
            ->where('er.id = :id')
            ->setParameter('id',$id);
           

 
        $query = $qb->getQuery();
        $results = $query->getResult();

	

	return $results; 


        
    }

     




     protected function _getTravellers($reservationId){
   //      return $collection;
	 $em = $this->getEntityManager();
         $travellers = array();
	 $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
         $qb = $em->createQueryBuilder();  
         $qb->select(array(              
            'cr.name AS clientName',
            'c.id AS deckid',
	    'c.amountTotal AS totalamount'
            ))->from('\Base\Entity\Avp\Orders', 'c')
            ->innerJoin('\Base\Entity\Avp\Clients', 'cr', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'c.clientId = cr.id')            
            ->where('c.id = :id')
            ->setParameter('id',$reservationId);

	  $query = $qb->getQuery();
          $results = $query->getResult();

     
          return $results; 
        
        
    }


    /* protected function _getTravellers($reservationId){
        
        $em = $this->getEntityManager();
        
        $travellers = array();
        
        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('orderId' => $reservationId));
        
        foreach ($collection as $traveller){
            $travellers[] = $traveller->getTraveller()->getName();
        }
        
        return $travellers;
        
        
    } */




}