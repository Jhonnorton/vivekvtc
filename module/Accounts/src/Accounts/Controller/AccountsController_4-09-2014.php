<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Accounts\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;

class AccountsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //echo "hello"; die;
        $this->model = $this->getModel('Accounts');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Accounts');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
 	$model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getCollection(),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
 
       public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Accounts\Form\PayrollForm($this->getEm(), $this->_entity);
        if($this->request->isPost()){    		
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            if($form->isValid()){
                
               // d('i m here');
                if($this->model->isValidModel($form)){
                 //          d('indise is valid');
                    $this->model->save($form->getData());
                    $this->addPageMessage('Payroll Information Updated.','success');
                    $this->redirect()->toRoute('accounts');
                }
            } else {
                d($form->getMessages());
            }    		
    	}    	    
        $view = $this->getView(array('form' => $form));
        return $view;
    }
    
    public function viewAction(){
        
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');
        
        
        $data = array('collection' => $this->model->getItemView($this->_entity->getId()));
//d($data);
        return $this->getView($data);        
    }
    
    public function commissionAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getCollection($type=1),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
    
    
    public function roleCommissionAction(){
        
    }
}
