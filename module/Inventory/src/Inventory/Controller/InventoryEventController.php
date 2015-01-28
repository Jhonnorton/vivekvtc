<?php

namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;

class InventoryEventController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {
        $this->model = $this->getModel('InventoryEvent');
        if ($this->params()->fromRoute('id', 0)) {
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);
    }

    public function indexAction() {
          foreach($this->model->getCollection() as $rows){
          $roomData = $this->model->getRoomsBookedCount($rows);
          $bookRoomsCount[$roomData[0][0]['eventRoom']['roomId']] = $roomData[0]['bookedCount'];
        }
        //rooms booked count not completed yet..the sold and availabale of rooms can be calculated from both event and resort reservations
        return $this->getView(array(
                    'collection' => $this->model->getCollection(),
                    'bookedCountArray' => $bookRoomsCount,
                    'message' => $this->getPageMessages(),
                ));
    }

    public function addAction() {

        $form = new \Inventory\Form\InventoryEventForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryEvent');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
           
            $form->setInputFilter($this->model->getInputFilter());
             
            $form->setData($data);
            
            if ($form->isValid()) {
                if ($this->model->isValidModel($form)) {
                    $this->model->save($form->getData());
                    $this->addPageMessage('The event room has been saved.', 'success');
                    $this->redirect()->toRoute('inventory-event-rooms');
                }
            } else{                
                $form->getMessages();
            }
            
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }

    public function editAction() {

        if (!$this->_entity) {
            throw new \Exception('Invalid Entity');
        }
        $form = new \Inventory\Form\InventoryEventForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $this->_entity);
        $form->get('submit')->setValue('edit');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                if ($this->model->isValidModelOnEdit($form)) {
                    $this->model->save($form->getData());
                    $this->addPageMessage('The event room has been updated.', 'success');

                    $this->redirect()->toRoute('inventory-event-rooms');
                }
            } else {
              d(  $form->getMessages());
            }
        }
        $view = $this->getView(array(
            'form' => $form
                ));

        return $view;
    }

    public function deleteAction() {
        if (!$this->_id && !$this->request->isPost()) {
            throw new \Exception('Invalid Entity');
        }
        $this->model->delete($this->_id);
        $this->addPageMessage('The event room has been deleted.', 'success');
        $this->redirect()->toRoute('inventory-event-rooms');
    }

}
