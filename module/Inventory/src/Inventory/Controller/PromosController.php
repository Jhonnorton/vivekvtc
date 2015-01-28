<?php
namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;
use Inventory\Model\Promos;

class PromosController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){
        
        Promos::initServiceManager($this->getServiceLocator());
        
        $this->model = $this->getModel('Promos');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
        }             
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);		
    }


    public function indexAction() {
        
        return $this->getView (array (
                'collection' => $this->model->getCollection(),				                                
                'message'=>$this->getPageMessages(),                
        ) );
    }
    
    public function addAction() {
        
        $form = new \Inventory\Form\PromosForm($this->getEm(), 
                $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryPromo');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);            
            if ($form->isValid()) {
                if($this->model->isValidModel($form)){
                    $this->model->saveObject($form->getData(), isset($data['ids']) ? $data['ids'] : null);
                    $this->addPageMessage('The promo has been saved.','success');
                    $this->redirect()->toRoute('inventory-promos');
                }
            } else {
                $form->getMessages();
            }
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }
    
    public function editAction() {
        if (!$this->_entity){
            throw new \Exception('Invalid Entity');
        }        
        $form = new \Inventory\Form\EditPromosForm($this->getEm(), 
                $this->getEm(self::AVP_CONFIG), $this->_entity);
        $form->get('submit')->setValue('edit');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();            
            $form->setInputFilter($this->model->getInputFilter());            
            $form->setData($data);            
            if ($form->isValid()) {                
                if($this->model->isValidModelOnEdit($form)){                    
                    $this->model->updateObject($form->getData(), isset($data['ids']) ? $data['ids'] : null);                    
                    $this->addPageMessage('The promo has been updated.','success');	
                    $this->redirect()->toRoute('inventory-promos');
                }                
            } else {                
                $form->getMessages ();
            }           
        }
        $form->initIds($this->_entity);            
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
        $this->addPageMessage('The promo has been deleted.','success');        
        $this->redirect()->toRoute('inventory-promos');
    }     
}
