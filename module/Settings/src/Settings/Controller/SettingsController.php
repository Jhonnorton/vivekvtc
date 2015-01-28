<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Users for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Settings\Controller;

use Zend\Mvc\MvcEvent;
use Zend;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class SettingsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {


        //d('before parent');
        $this->model = $this->getModel('Disclaimers');

//        if ($this->params()->fromRoute('id', 0)) {
//            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
//        }

        $e->getViewModel()->setVariable('modulename', 'Settings');
        //d($this->getSessionData('Zend_Auth'));
        return parent::onDispatch($e);
    }

    public function indexAction() {
        $model = $this->getModel('Disclaimers');
        $data = array(
            'collection' => $model->getCollection(),
            'message' => $this->getPageMessages(),
        );
        return $this->getView($data);
        
//        echo "Settings"; die;
    }
    
    public function addDisclaimerAction(){
        if ($this->request->isPost()) {

            $data = $this->request->getPost();
            $this->model->saveDisclaimer($data);
            $this->addPageMessage('New Disclaimer has been Added.', 'success');
            $this->redirect()->toRoute('settings');
             
        }
    }
    public function editDisclaimerAction(){
        $id=$this->params()->fromRoute('id', 0);
        if ($this->request->isPost()) {

            $data = $this->request->getPost();
            $this->model->editDisclaimer($data);
            $this->addPageMessage('Disclaimer has been Updated.', 'success');
            $this->redirect()->toRoute('settings');
             
        }
        $data = array(
            'data' => $this->model->getDisclaimerData($id),
            'message' => $this->getPageMessages(),
        );
        return $this->getView($data);
    }
    
    public function viewDisclaimerAction(){
        $id=$this->params()->fromRoute('id', 0);
         $data = array(
            'data' => $this->model->getDisclaimerData($id),
            'message' => $this->getPageMessages(),
        );
         
         $result = new ViewModel();
        $result->setTerminal(true);
        $result->setVariables($data);
        return $result;
    }

}
