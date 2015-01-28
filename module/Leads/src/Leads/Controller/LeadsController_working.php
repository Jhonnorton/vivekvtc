<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Leads\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;

class LeadsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //     echo 'hello'; die;


        $this->model = $this->getModel('Leads');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Leads');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {

        $data = array('collection' => $this->model->getCollection(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollection($startdate, $enddate),);
            //   return $this->getView($data);
        }

        return $this->getView($data);
        //echo "hello index"; die;
    }

    public function addAction() {

        $form = new \Leads\Form\AddLeadsForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Leads');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            //   echo "<pre>"; print_r($data);
            //   die;
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            //if ($form->isValid()) {
            //d($data);

            $reservation = $this->model->save($data);
            $this->addPageMessage('The lead has been saved.', 'success');
            $this->redirect()->toRoute('leads');

            // d($reservation);
            //send email 

            if (!empty($data['savesend'])) {
                //$id = $reservation->getId();
                $id = 1;
                $to = isset($data['email']) ? $data['email'] : '';
                $url = $this->url()->fromRoute('leads', array(), array('force_canonical' => true));
                $this->model->sendmail($id, $to);
                //  echo "mail sent";
                //  die;
            }

            return $this->redirect()->toRoute('leads');
            // } else {
            $form->getMessages();
            // }
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }

    public function viewAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');


        $data = array('leads' => $this->model->getItemView($this->_entity->getId()));

        // d($data);    die;
        return $this->getView($data);
    }

    public function resortAction() {

        $data = array('collection' => $this->model->getResort(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getResort($startdate, $enddate),);
            //   return $this->getView($data);
        }
        //  echo "<pre>";        print_r($data); die;    
        return $this->getView($data);
        //echo "hello index"; die;
    }

    public function cruiseAction() {

        $data = array('collection' => $this->model->getCruise(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCruise($startdate, $enddate),);
        }

        return $this->getView($data);
    }

    public function eventAction() {

        $data = array('collection' => $this->model->getEventLead(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getEventLead($startdate, $enddate),);
        }

        return $this->getView($data);
    }

    public function sendmailAction() {
     
        //      d($data);


        
        
        
        
        if ($this->request->isPost()) {
           $dta=$this->request->getPost(); 
           echo "<pre>"; print_r($dta['toemail']); die;
            $to = isset($data['email']) ? $data['email'] : '';
            $url = $this->url()->fromRoute('leads', array(), array('force_canonical' => true));
            $this->model->sendmail($id, $to);   

            //  d($this->request->getPost());
            $data = array('collection' => $this->model->update($this->request->getPost()),);
            //$form->setData($this->request->getPost());
            //$this->model->update($form->getData());
            $this->addPageMessage('The  has been Sent.', 'success');
            $this->redirect()->toRoute('leads');
        }

         $data = array('leads' => $this->model->getItemView($this->_entity->getId()));
        return $this->getView($data);
    }

}
