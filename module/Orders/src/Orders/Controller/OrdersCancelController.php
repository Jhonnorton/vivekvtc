<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Orders\Controller;

use Zend\Mvc\MvcEvent;

class OrdersCancelController extends \Base\Controller\BaseController
{
    protected $_entity = false;

    public function onDispatch(MvcEvent $e){
        
        
    	$this->model = $this->getModel('Orders');		
	if($this->params()->fromRoute('id', 0)){				
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));				
        }		
	$e->getViewModel()->setVariable('modulename', 'Orders');		
	return parent::onDispatch($e);//smart	
        
        
        
    }
    
 
	
    public function indexAction(){ 
	    
      //$this->model = $this->getModel('Orders');
	$type =3;		  
       $data = array('collection' => $this->model->getCollection(null,null,false,$type),'message' => $this->getPageMessages(),);
       
        if ($this->request->isPost()) {
            $startdate=$this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            
            $data = array('collection' => $this->model->getCollection($startdate,$enddate,false,$type),);
         //   return $this->getView($data);
       }

        return $this->getView($data);
    }

   public function deleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->delete($this->_id);
        return $this->redirect()->toRoute('orders-event');
    }

    public function viewAction(){

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');
        
        
        $data = array('reservation' => $this->model->getItemView($this->_entity->getId()));

        return $this->getView($data);        
    }

    
    public function cancelAction() {

	  

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');
        
        $this->model->cancelResortReservation($this->_id);
         $this->addPageMessage('Order has been reinstated.', 'success');
        return $this->redirect()->toRoute('orders-cancel');
    }
	


    public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

	//    echo "<pre>";
	  //  print_r( $this->_entity);
	    //die;
	    
	   //  $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');

      //  $form = new \Orders\Form\OrdersForm($this->getEm(), $this->_entity);

	  $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Orders');
	  
	   // echo "<pre>";
	   // print_r( $this->_entity);
	   //die;

	//  echo "<pre>";
	  //print_r($form);
	  //die;
	    


        //$form->get('submit')->setValue('edit');

        if ($this->request->isPost()) {

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $this->model->save($form->getData());
                return $this->redirect()->toRoute('orders-cruise');
            } else {
                $form->getMessages();
            }
        }


        $view = $this->getView(array('form' => $form));

        return $view;
    }




   
}
