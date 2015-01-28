<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Orders\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;

class OrdersEventController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {


        $this->model = $this->getModel('Orders');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Orders');

       return parent::onDispatch($e);//smart
    }



 /*   public function onDispatch(MvcEvent $e) {
        $this->model = $this->getModel('InventoryEvent');
        if ($this->params()->fromRoute('id', 0)) {
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);
    }
*/  


    public function indexAction() {
        
        $data = array('collection' => $this->model->getCollection(),);

        return $this->getView($data);
    }

/*    public function addAction() {         
        
        //d($this->getEm(self::AVP_CONFIG));
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
        
        //d($form);
        
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            //d($data);
            
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            //if ($form->isValid()) {
            //d($data);
                $reservation = $this->model->save($data);
                
                //send email 
                $id = $reservation->getId();  
                $to = isset($data['travellerEmail'])? $data['travellerEmail']:'';
                $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));                                                   
                $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
                
                return $this->redirect()->toRoute('orders');
           // } else {
                $form->getMessages();
           // }
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }

    public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Orders\Form\OrdersForm($this->getEm(), $this->_entity);

        $form->get('submit')->setValue('edit');

        if ($this->request->isPost()) {

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $this->model->save($form->getData());
                return $this->redirect()->toRoute('orders');
            } else {
                $form->getMessages();
            }
        }


        $view = $this->getView(array('form' => $form));

        return $view;
    }

    public function deleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->delete($this->_id);
        return $this->redirect()->toRoute('orders');
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
        
        $this->model->cancelReservation($this->_id);
        return $this->redirect()->toRoute('orders');
    }
*/
    /*
    public function sendmailAction() {
        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');
        
        $id = $this->_entity->getId();    
        $to = 'admin@gmail.com';                                 
        $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));                                                   
        $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
        
        return $this->redirect()->toRoute('orders');
    }     
     */
}
