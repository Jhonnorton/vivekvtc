<?php

namespace Reports\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Sendmail\Controller\SendmailController;
use Reports\Controller\ReportsController;

class AjaxController extends AbstractActionController {

    protected $_entity = false; 
    public $model;
    
    const RESORT_ROOMS = 1;
    const EVENT_ROOMS = 2;
    const CRUISE_CABINS = 3;
    
    public function onDispatch(MvcEvent $e){
    
        $e->getViewModel()->setVariable('modulename', 'ReportsAjaxModel');                
        $this->layout('layout/ajax');
        return parent::onDispatch($e);			
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }
     
    public function typeAction() {
        
      // echo 'hello';die;
        
        $id = $this->params()->fromRoute('id', 0);      
        $typeid = $this->params()->fromRoute('typeid', 0); 
        $source = $this->params()->fromRoute('source',null);
        
      // echo $id; die;
        $this->model = $this->getModel('ReportsAjaxModel');        
        $rooms = $this->model->getallCollection($id,$source);                        
        $data = array(
            'collection' => $rooms,
            'id'=>$id,
            'typeId'=>$typeid
        );
       
       // echo '<pre>';
       // print_r($data);die;
        return new ViewModel($data);
    }
    public function userAction() {
      $roleid = $this->params()->fromRoute('id', 0);      
        
        $this->model = $this->getModel('ReportsAjaxModel');        
        $users = $this->model->getallUsers($roleid);                        
        $data = array(
            'collection' => $users,             
        );
//       
//        echo '<pre>';
//        print_r($data);die;
        return new ViewModel($data);
    }
        
 
 
}
