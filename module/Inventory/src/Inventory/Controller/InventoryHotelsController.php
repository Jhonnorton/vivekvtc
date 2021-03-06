<?php
namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;

class InventoryHotelsController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){

        $this->model = $this->getModel('InventoryHotels');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
        }             
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);		
    }


    public function indexAction() {
        foreach($this->model->getCollection() as $rows){
          $roomData = $this->model->getRoomsBookedCount($rows);
          $bookRoomsCount[] = $roomData[0]['bookedCount'];
        }
        
        return $this->getView (array (
                'collection' => $this->model->getCollection(),
                'bookedCountArray' => $bookRoomsCount,
                'message'=>$this->getPageMessages(),                
        ) );
    }
    
    public function addAction() {
        
        $form = new \Inventory\Form\InventoryHotelsForm($this->getEm(), 
        $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryHotels');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            if ($form->isValid()){                 
                if($this->model->isValidModel($form)){                                                       
                    $this->model->save($form->getData());
                    $this->addPageMessage('The hotel room has been saved.','success');	
                    $this->redirect()->toRoute('inventory-resort-rooms');			                
                }                
            }             
            $form->getMessages();            
        }
        $view = $this->getView(array('form' => $form));
        return $view;

    }
    
    public function editAction() {
        if (!$this->_entity){
            throw new \Exception('Invalid Entity');
        }
        $form = new \Inventory\Form\InventoryHotelsForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $this->_entity);
        $form->get('submit')->setValue('edit');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                if($this->model->isValidModelOnEdit($form)){
                    $this->model->save($form->getData());
                    $this->addPageMessage('The hotel room has been updated.','success');
                    $this->redirect()->toRoute('inventory-resort-rooms');	
                }
            } else {
                $form->getMessages ();
            }
        }
        $view = $this->getView(array (
                        'form' => $form
        ) );
        return $view;
    }

    public function deleteAction() {        
        if(!$this->_id && !$this->request->isPost()){        
            throw new \Exception('Invalid Entity');
        }
        $this->model->delete($this->_id);
        $this->addPageMessage('The hotel room has been deleted.','success');        
        $this->redirect()->toRoute('inventory-resort-rooms');
    }        
}
