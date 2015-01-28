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

class InvoiceController extends \Base\Controller\BaseController
{
    protected $_entity = false;

    public function onDispatch(MvcEvent $e){
        
        
    	$this->model = $this->getModel('Invoices');		
	if($this->params()->fromRoute('id', 0)){
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));				
        }		
	$e->getViewModel()->setVariable('modulename', 'Orders');		
	return parent::onDispatch($e);//smart	
        
        
        
    }
    
    
	
    public function indexAction(){    	
        
     //   $form = new \Orders\Form\InvoiceForm($this->getEm(), '\Base\Entity\Avp\Orders');
        $data = array(
            'collection' => $this->model->getCollection(),
           
        );    	
        return $this->getView($data);
    }
	
    public function addAction()
    {
        
       
    	$form = new \Orders\Form\AddInvoiceForm($this->getEm(), '\Base\Entity\Avp\Orders'); 

        
        
    	if($this->request->isPost()){    				
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
                if($form->isValid()){
                        $this->model->save($form->getData());
                        return $this->redirect()->toRoute('ivoice');
                } else {
                        $form->getMessages(); 
                }
    	}
    	$view = $this->getView(
                array(
                    'form' => $form,
                    'collection'=>array()
                ));
    	return $view;
    }
    
    public function editAction()
    {
    	if(!$this->_entity)
    		throw new \Exception('Invalid Entity');
    	
    	$form = new \Orders\Form\InvoceForm($this->getEm(), $this->_entity);
    	
    	$form->get('submit')->setValue('edit');
    	
    	if($this->request->isPost()){
    		
    		$form->setInputFilter($this->model->getInputFilter());
    		$form->setData($this->request->getPost());
    			
    		if($form->isValid()){
    			$this->model->save($form->getData());
    			return $this->redirect()->toRoute('invoice');
    		} else {
    			$form->getMessages();
    		}
    		
    	}
    	
    	
    	$view = $this->getView(array('form' => $form));
    	
    	return $view;
    }
    
    public function deleteAction()
    {
    	
    	if(!$this->_id && !$this->request->isPost())
    			throw new \Exception('Invalid Entity');

    	$this->model->delete($this->_id);
    	return $this->redirect()->toRoute('invoice');
    }


    public function viewAction(){

	if (!$this->_entity)
            throw new \Exception('Invalid Entity');
        
        
        $data = array('reservation' => $this->model->getItemView($this->_entity->getId()));

        return $this->getView($data); 

    }



   
}
