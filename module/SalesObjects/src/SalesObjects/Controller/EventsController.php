<?php

namespace SalesObjects\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class EventsController extends \Base\Controller\BaseController {
	        
	protected $_entity = false;
        protected $_session = null;
	
	public function onDispatch(MvcEvent $e){
		$this->_session = new Container('image');
		$this->model = $this->getModel('Events');	
		if($this->params()->fromRoute('id', 0)){				
			$this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
		}	
		$e->getViewModel()->setVariable('modulename', 'SalesObjects');
		return parent::onDispatch($e);		
	}
	
	public function indexAction() {

		return $this->getView (array (
				'collection' => $this->model->getEventsCollection(),				                                
                                'message'=>$this->getPageMessages(),
                                'imagePath'=>$this->model->getImagePath(),
		) );
	}
              
	public function addAction() {

                $form = new \SalesObjects\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Events' );							
		if ($this->request->isPost()) {                        
			$files = $this->request->getFiles()->toArray();                        
                        $data = $this->request->getPost ();    
                        $data['image'] = $files['image']['name']; 			
			$form->setInputFilter($this->model->getInputFilter());
			$form->setData($data);
			if ($form->isValid ()) {
                               if($this->model->isValidModel($form) &&
                                   $this->model->isValidImage($form, $files)){	
                                        //$form->getData()->setUserId((int)$this->getSessionData('User', 'user')->getId());

                                         if(((int)$this->getSessionData('User', 'user'))){
                                            $userObject = $this->model->getUserObject($this->getSessionData('User', 'user')->getId());

                                            $form->getData()->setUserId($userObject);
                                        }
	
                                        $object = array('object'=>$form->getData(), 
                                                        'files'=>$files);                                    
					$obj = $this->model->save($object);				
                                        $this->addPageMessage('The event has been saved.','success');
                                        //added anup
                                        $resortId = $obj->getResortId();

                                        $rooms = $this->model->getRooms(array("resortId"=> $resortId,"eventId"=>$obj->getId()));

                                        $viewModel = new ViewModel();
                                        $viewModel->setVariable("eventRoom",$rooms);
                                        $viewModel->setVariable("eventId",$obj->getId());
                                        $viewModel->setVariable("resortId",$resortId);
                                        $viewModel->setTemplate('sales-objects/events/event-rooms.phtml');
                                        return $viewModel;
                                        
                                        //$this->redirect()->toRoute('events');
				}
			} else {
				$form->getMessages();
			}
		}
	
		$view = $this->getView ( array (
				'form' => $form
		) );
	
		return $view;
	}
	
        
	public function editAction() {
		if (!$this->_entity)
			throw new \Exception('Invalid Entity');
	
		$form = new \SalesObjects\Form\EventsForm($this->getEm(self::AVP_CONFIG), $this->_entity);
		$form->get('submit')->setValue('edit');
		if ($this->request->isPost()) {
                        $files = $this->request->getFiles()->toArray();                        
                        $data = $this->request->getPost ();    
                        if(!empty($files['image']['name'])){                              
                            $data['image'] = $files['image']['name'];                                
                        }
			$form->setInputFilter ( $this->model->getInputFilter () );
			$form->setData ( $data );
			if ($form->isValid ()) {
				if($this->model->isValidModelOnEdit($form) &&
                                   $this->model->isValidImage($form, $files)){
					$object = array('object'=>$form->getData(),                                                         
                                                        'tmpImage'=>$this->_session->offsetGet('image'),
                                                        'files'=>$files); 
                                        $this->model->update($object);						
					$this->addPageMessage('The event has been updated.','success');	
					$this->redirect()->toRoute('events');
				}
			} else {
				$form->getMessages ();
			}
		}else{                    
                    $this->_session->offsetSet('image', $this->_entity->getImage());
                }
		
		$view = $this->getView ( array (
				'form' => $form,
                                'image'=>$this->model->getImagePath().$this->_session->offsetGet('image'),
		) );
	
		return $view;
	}
	public function deleteAction(){
		if(!$this->_id && !$this->request->isPost())
			throw new \Exception('Invalid Entity');
	
		$this->model->delete($this->_id);
		$this->addPageMessage('The event has been deleted.','success');
		$this->redirect()->toRoute('events');
	}         
                
       
}
