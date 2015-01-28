<?php

namespace SalesObjects\Controller;

use Zend\Mvc\MvcEvent;

class PortsController extends \Base\Controller\BaseController {
	
	protected $_entity = false;
	
	public function onDispatch(MvcEvent $e){
	
		$this->model = $this->getModel('Ports');
		if($this->params()->fromRoute('id', 0)){
			$this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
		}
		$e->getViewModel()->setVariable('modulename', 'SalesObjects');
		return parent::onDispatch($e);
	}
	
	public function indexAction() {
		
		return $this->getView (array (
				'collection' => $this->model->getPortsCollection(),
				'message'=>$this->getPageMessages(),
		) );
	}
	
	public function addAction() {
	
		$form = new \SalesObjects\Form\PortsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\CruisePorts' );
		if ($this->request->isPost()) {
			$data = $this->request->getPost();
			$form->setInputFilter($this->model->getInputFilter() );
			$form->setData($data);
			if ($form->isValid ()) {
				if($this->model->isValidModel($form)){
                                    
					$this->model->save($form->getData());	
					$this->addPageMessage('The port has been saved.','success');	
					$this->redirect()->toRoute ('ports');
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
	
		$form = new \SalesObjects\Form\PortsForm($this->getEm(self::AVP_CONFIG), $this->_entity);
		$form->get('submit')->setValue('edit');
		if ($this->request->isPost()) {
			$data = $this->request->getPost ();
			$form->setInputFilter ( $this->model->getInputFilter () );
			$form->setData ( $data );
			if ($form->isValid()) {
				if($this->model->isValidModelOnEdit($form)){
					$this->model->save($form->getData());	
					$this->addPageMessage('The port has been updated.','success');	
					$this->redirect()->toRoute('ports');
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
		
	public function deleteAction(){
		if(!$this->_id && !$this->request->isPost())
			throw new \Exception('Invalid Entity');
		$this->model->delete($this->_id);
		$this->addPageMessage('The port has been deleted','success');
		$this->redirect()->toRoute('ports');
	}
        
         
}