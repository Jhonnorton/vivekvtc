<?php

namespace Manageclients\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

//class AjaxController extends \Base\Controller\BaseController {
class AjaxController extends AbstractActionController {    
    	
        protected $_entity = false; 
        public $model;

        public function onDispatch(MvcEvent $e){
						
		$e->getViewModel()->setVariable('modulename', 'SalesObjects');                
                $this->layout('layout/ajax');
                
		return parent::onDispatch($e);			
	}
       	
	public function clientAction() {
            
            $this->model = $this->getModel('Manageclients');
            $entity = $this->model->getItem($this->params()->fromRoute('id', 0));                        
            $country  =  $this->getEm()->getRepository('\Base\Entity\Avp\Countries')->findOneById($entity->getCountryId());            
            $data = array(
                'item' => $entity,                                 
                'country'  => $country,
            );
            
            return new ViewModel($data);                                   
	}
        
        
        public function noteviewAction() {
            
            $this->model = $this->getModel('Manageclients');
            $notedetail = $this->model->getNoteDetails($this->params()->fromRoute('id', 0));                        
            
            $data = array(
                'note' => $notedetail,                                 
                
            );
            
            return new ViewModel($data);                                   
	}
        
        public function viewInvoiceAction() {
            
            $this->model = $this->getModel('Manageclients');
            $invoicedetail = $this->model->getInvoiceDetails($this->params()->fromRoute('id', 0));                        
            $userdetails = $this->model->getUser($this->params()->fromRoute('uId', 0));
            $userreservation = $this->model->getReservationDetails($this->params()->fromRoute('id', 0));
            $userreservationitem = $this->model->getReservationItem($this->params()->fromRoute('id', 0),'item');
            $userreservationtransfer = $this->model->getReservationItem($this->params()->fromRoute('id', 0),'transfer');
            $userreservationexcursion = $this->model->getReservationItem($this->params()->fromRoute('id', 0),'excursion');
            $bookingdetails = $this->model->getBookingDetails($userreservation->getType(),$this->params()->fromRoute('id', 0));
            $data = array(
                'invoice' => $invoicedetail[0],                                 
                'user' => $userdetails,
                'reservation' => $userreservation,                                 
                'items'=> $userreservationitem,
                'transfer' => $userreservationtransfer,
                'excursion' =>$userreservationexcursion, 
                'details'=>$bookingdetails,
            );
            return new ViewModel($data);                                   
	}
        
        protected function getEm(){
            return $this->getServiceLocator()->get('doctrine.entitymanager.orm_avp');
        }
        
        protected function getModel($model) {
            return $this->getServiceLocator()->get($model);
        }
}
