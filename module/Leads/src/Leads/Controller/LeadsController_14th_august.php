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
            //$data = array('collection' => $this->model->getCollection($startdate, $enddate),);
            //   return $this->getView($data);
            $data = array('collection' => $this->model->getCollection($startdate, $enddate),'startdat'=>$startdate,'enddat'=>$enddate);
           
        }

        return $this->getView($data);
        //echo "hello index"; die;
    }

    public function addAction() {

        $form = new \Leads\Form\AddLeadsForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Leads');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
        //    echo "<pre>"; print_r($data);
          //  die;
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            
            
            
            $reservation = $this->model->save($data);
                       
            if (!empty($data['submit'])) {
                
                $to = isset($data['email']) ? $data['email'] : '';
                $subject = isset($data['subject']) ? $data['subject'] : '';
                $message = isset($data['message']) ? $data['message'] : '';
                $this->model->sendmailnew($to,$subject,$message,$cc="null");  
            }
            
            $this->addPageMessage('The lead has been saved.', 'success');
            $this->redirect()->toRoute('leads');

           // return $this->redirect()->toRoute('leads');
            // } else {
           // $form->getMessages();
            // }
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }

    public function viewAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');


        $data = array('leads' => $this->model->getItemView($this->_entity->getId()));

        //d($data);    die;
        return $this->getView($data);
    }

    public function resortAction() {

        $data = array('collection' => $this->model->getResort(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
        //    $data = array('collection' => $this->model->getResort($startdate, $enddate),);
            $data = array('collection' => $this->model->getResort($startdate, $enddate),'startdat'=>$startdate,'enddat'=>$enddate);
   
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
            $data = array('collection' => $this->model->getCruise($startdate, $enddate),'startdat'=>$startdate,'enddat'=>$enddate);
   
        }

        return $this->getView($data);
    }

    public function eventAction() {

        $data = array('collection' => $this->model->getEventLead(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getEventLead($startdate, $enddate),'startdat'=>$startdate,'enddat'=>$enddate);
   
        }

        return $this->getView($data);
    }

    public function sendmailAction() {
        if ($this->request->isPost()) {
           $dta=$this->request->getPost(); 
           //echo "<pre>"; print_r($dta); die;
            $to = isset($dta['toemail']) ? $dta['toemail'] : '';
            $subject = isset($dta['subject']) ? $dta['subject'] : '';
            $message = isset($dta['message']) ? $dta['message'] : '';
            $cc = isset($dta['ccemail']) ? $dta['ccemail'] : '';
           // $url = $this->url()->fromRoute('leads', array(), array('force_canonical' => true));
            $this->model->sendmailnew($to,$subject,$message,$cc);   

            $data = array('collection' => $this->model->update($this->request->getPost()),);
        
            $this->addPageMessage('The mail has been Sent.', 'success');
        
            $this->redirect()->toRoute('leads-resort');
        }

         $data = array('leads' => $this->model->getItemView($this->_entity->getId()));
        return $this->getView($data);
    }
    
    
    public function sendquoteAction() {
        
       // d($this->_entity);
          $form = new \Leads\Form\AddQuoteForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $this->_entity);
          
          
          
           if ($this->request->isPost()) {
                $dta=$this->request->getPost(); 
                d($dta);
           }
          
          
          
          
          
      //    d($form);
          $data = array('leads' => $this->model->getItemView($this->_entity->getId()));
         //d($data);
           $roomdetail=$this->model->getRoomDetail($data);
           $rooms=$this->model->getRooms($data);
            $view = $this->getView(array(
            'form' => $form,
            'id' => $this->_id,
            'data'=>$data,
            'roomdetails'=>$roomdetail,
            'rooms'=>$rooms,    

        ));
          
          
            return $view;
          
          /*        $leads= $this->model->getItemView($this->_id);
        $data_url = array("type"=>$leads['typeid'] ,"typeId"=>$leads['Typename'],"id"=>$leads['lead']->getRoomId(),"start"=>$leads['dateFrom']->format('Y-m-d'),"end"=>$leads['dateTo']->format('Y-m-d'),"leadid"=>$leads['id']);
        $data_url = urlencode(json_encode($data_url));
        $to =$leads['email'];
        $this->model->sendquote($to,array($leads),array('link' =>'http://192.155.246.146:9065/reservation/'.$data_url, 'linkName' => 'Link to Reservation'));
        return $this->redirect()->toRoute('leads');
 */ 
    }
 

}
