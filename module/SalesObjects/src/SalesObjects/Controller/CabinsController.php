<?php

namespace SalesObjects\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class CabinsController extends \Base\Controller\BaseController {
	        
	protected $_entity = false;
        protected $_session = null;
	
	public function onDispatch(MvcEvent $e){
		$this->_session = new Container('image');
		$this->model = $this->getModel('Cabins');
		if($this->params()->fromRoute('id', 0)){
			$this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
		}
		$e->getViewModel()->setVariable('modulename', 'SalesObjects');
		return parent::onDispatch($e);		
	}
	
	
	public function indexAction() {
		return $this->getView (array (
				'collection' => $this->model->getCabinsCollection(),				                                
                                'message'=>$this->getPageMessages(),
                                'imagePath'=>$this->model->getImagePath(),
		) );
	}

	public function addAction() {

            
                
            
		$form = new \SalesObjects\Form\CabinsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\CruiseCabins' );																
		
		if ($this->request->isPost()) {
			$files = $this->request->getFiles()->toArray();                        
                        $data = $this->request->getPost ();    
                        $data['deckImageUrl'] = $files['deckImageUrl']['name'];                         
			$form->setInputFilter($this->model->getInputFilter());
			$form->setData($data);
                        
			if ($form->isValid ()) {
				if($this->model->isValidModel($form) &&
                                   $this->model->isValidImage($form, $files)){				
					$object = array('object'=>$form->getData(), 
                                                        'files'=>$files);                                        
					$this->model->save($object);				
					$this->addPageMessage('The cabin has been saved.','success');	
					$this->redirect()->toRoute('cabins');
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
	
		$form = new \SalesObjects\Form\CabinsForm($this->getEm(self::AVP_CONFIG), $this->_entity);
		$form->get('submit')->setValue('edit');
		if ($this->request->isPost()) {
			$files = $this->request->getFiles()->toArray();                        
                        $data = $this->request->getPost ();    
                        if(!empty($files['deckImageUrl']['name'])){                              
                            $data['deckImageUrl'] = $files['deckImageUrl']['name'];                                
                        }                        
			$form->setInputFilter ( $this->model->getInputFilter () );
			$form->setData ( $data );
			if ($form->isValid ()) {
				if($this->model->isValidModelOnEdit($form)&&
                                   $this->model->isValidImage($form, $files)){                                    
					$object = array('object'=>$form->getData(),                                                         
                                                        'tmpImage'=>$this->_session->offsetGet('image'),
                                                        'files'=>$files); 
                                        $this->model->update($object);	
                                        $this->_session->getManager()->getStorage()->clear('image');				
					$this->addPageMessage('The cabin has been updated.','success');	
					$this->redirect()->toRoute('cabins');
				}
			} else {
				$form->getMessages ();
			}
		}else{                    
                    $this->_session->offsetSet('image', $this->_entity->getDeckImageUrl());
                }
		$view = $this->getView(array (
				'form' => $form,
                                'image'=>$this->model->getImagePath().$this->_session->offsetGet('image'),                                
		) );
	
		return $view;
	}
	public function deleteAction(){
		if(!$this->_id && !$this->request->isPost())
			throw new \Exception('Invalid Entity');
	
		$this->model->delete($this->_id);
		$this->addPageMessage('The cabin has been deleted.','success');
		$this->redirect()->toRoute('cabins');
	}
        
        
}
