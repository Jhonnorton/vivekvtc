<?php
namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;

class ExcursionsController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){

        $this->model = $this->getModel('Excursions');
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
        
        $form = new \Inventory\Form\ExcursionsForm($this->getEm(), 
                $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryExcursion');
        if ($this->request->isPost()) {
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                if($this->model->isValidModel($form)){
                    $files = $this->request->getFiles()->toArray();
                    $date=strtotime(date('Y-m-d H:i:s'));
                    $form->getData()->setImage($date."-".$files['image']['name']);
//                    d($files);
                    $this->model->save($form->getData(),$files,$date);
                    $this->addPageMessage('The excursion has been savad.','success');	
                    return $this->redirect()->toRoute('inventory-excursions');
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
        $form = new \Inventory\Form\ExcursionsForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $this->_entity);
        $form->get('submit')->setValue('edit');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                if($this->model->isValidModelOnEdit($form)){
                    $this->model->save($form->getData());	
                    $this->addPageMessage('The excursion has been updated.','success');	
                    return $this->redirect()->toRoute('inventory-excursions');
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
        $reservations = $this->model->getReservationExcursions($this->_id);
        
        $flag =0 ;
        foreach($reservations as $rows):
            if($rows->getReservation()->getIsDeleted() == 0){
                $flag = 1;
            }
        endforeach;
        if($flag == 0){
            $this->model->delete($this->_id);
            $this->addPageMessage('The excursion has been deleted.','success');  
        }else{
            $this->addPageMessage('Sorry excursion cannot be deleted as it is linked to reservation.','success');
        }      
        return $this->redirect()->toRoute('inventory-excursions');
    }
}
