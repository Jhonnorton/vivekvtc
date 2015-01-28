<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Reports\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class ReportsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //echo "hello"; die;
        $this->model = $this->getModel('Reports');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Reports');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {

        $data = array('collection' => $this->model->getCollection(),);
        // d($data);

        if ($this->request->isPost()) {

            // d($this->getRequest()->getPost());

            $paymenttype = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollection($paymenttype, $typeId,$startdate, $enddate), 'paymenttyp' => $paymenttype, 'typeId'=>$typeId,'startdat' => $startdate, 'enddat' => $enddate);
            //  $this->csvAction('sale',$data);
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    protected function csvAction($filename = null, $resultset = null) {

        //d($resultset);


        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }

        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //d($response);
        return $response;
    }

    public function reservationAction() {

        // d('heer');

        $data = array('collection' => $this->model->getreservationCollection(),);
        // d($data);

        if ($this->request->isPost()) {

            // d($this->getRequest()->getPost());

            $paymenttype = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getreservationCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'typeId'=>$typeId,'startdat' => $startdate, 'enddat' => $enddate);
            //  $this->csvAction('sale',$data);
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    protected function csvReservationAction($filename = null, $resultset = null) {

        //d($resultset);


        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getreservationCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }

        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-reservation')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //d($response);
        return $response;
    }

    public function roomNightAction() {

        //  d('heer');

        $data = array('collection' => $this->model->getroomnightreservationCollection(),);
        // d($data);

        if ($this->request->isPost()) {

            // d($this->getRequest()->getPost());

            $paymenttype = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getroomnightreservationCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype,'typeId'=>$typeId, 'startdat' => $startdate, 'enddat' => $enddate);
            //  $this->csvAction('sale',$data);
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    protected function csvRoomNightAction($filename = null, $resultset = null) {

        //d($resultset);


        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getroomnightreservationCollection($paymenttype, $typeId,$startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }

        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-roomnight')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //   d($response);
        return $response;
    }

    public function roomingAction() {
        $data = array('collection' => $this->model->getroomingCollection(), 'countries'=>$this->model->getResortCountries());
        
         if ($this->request->isPost()) {

            // d($this->getRequest()->getPost());

            $paymenttype = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $country = $this->getRequest()->getPost('country');
//            d($country);
            $data = array('collection' => $this->model->getroomingCollection($paymenttype, $typeId,$startdate, $enddate,$country), 'paymenttyp' => $paymenttype, 'typeId'=>$typeId,'startdat' => $startdate, 'enddat' => $enddate, 'countries'=>$this->model->getResortCountries(),'country'=>$country);
            //  $this->csvAction('sale',$data);
            return $this->getView($data);
        }
        
        return $this->getView($data);
    }
    
    public function agentAction() {
        
//        d($this->_entity);
//        $authNamespace = new Zend_Session_Namespace('Zend_Auth');
//        echo "<pre>"; print_r($_SESSION['Zend_Auth']['storage']['id']); die;
        $data = array('collection' => $this->model->getagentrole(),'search'=>$this->model->getActivity($_SESSION['Zend_Auth']['storage']['id'],null,null));
        if ($this->request->isPost()) {

//             d($this->getRequest()->getPost());
            $role = $this->getRequest()->getPost('myselect');
            $userid = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
//            d($userid);
            $data = array('collection' => $this->model->getagentrole(),'search' => $this->model->getActivity($userid, $startdate, $enddate), 'role'=>$role,'userid' => $userid, 'startdat' => $startdate, 'enddat' => $enddate);
//            d($data);
            return $this->getView($data);
        }
        
         return $this->getView($data);
    }
    
    public function csvagentAction() {
        
         if ($this->request->isPost()) {
            $role = $this->getRequest()->getPost('myselect');
            $userid = $this->getRequest()->getPost('userId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $filename = $this->getRequest()->getPost('filename');
            
            $resultset = array('collection' => $this->model->getActivity($userid, $startdate, $enddate), 'role'=>$role,'userid' => $userid, 'startdat' => $startdate, 'enddat' => $enddate);
    
         }
         
         $filename = $filename . "_" . date("d-M-Y_H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-agent')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

/* @var $columnHeaders type */
        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
//           d($response);
        return $response;
     }

    protected function csvroomingAction($filename = null, $resultset = null) {

        //d($resultset);

        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getroomingCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }
      //  $resultset = array('collection' => $this->model->getroomingCollection());


        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-rooming')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

/* @var $columnHeaders type */
        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //   d($response);
        return $response;
    }
    
    public function commisionAction() {
        
        $data = array('collection' => $this->model->getcommissionCollection());
        
        if ($this->request->isPost()) {

            //d($this->getRequest()->getPost());

            $paymenttype = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getcommissionCollection($paymenttype, $typeId,$startdate, $enddate), 'paymenttyp' => $paymenttype, 'typeId'=>$typeId,'startdat' => $startdate, 'enddat' => $enddate);
            //  $this->csvAction('sale',$data);
            return $this->getView($data);
        }
        
        
        
         return $this->getView($data);
    }
    
    protected function csvcommissionAction($filename = null, $resultset = null) {

        //d($resultset);


        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getcommissionCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }
//        d($resultset);
        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-commission')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //d($response);
        return $response;
    }

    
    public function profitlossAction() {
        $data = array('collection' =>$this->model->getprofitCollection());
        
        if ($this->request->isPost()) {

            //d($this->getRequest()->getPost());

            $type = $this->getRequest()->getPost('myselect');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getprofitCollection($type, $typeId,$startdate,$enddate), 'paymenttyp' => $type, 'typeId' => $typeId,'startdat'=>$startdate,'enddat'=>$enddate);
//            d($data);
            return $this->getView($data);
        }
        
        
        
         return $this->getView($data);
    
    }
    
    protected function csvprofitlossAction($filename = null, $resultset = null) {

        //d($resultset);


        if ($this->request->isPost()) {

            $filename = $this->getRequest()->getPost('filename');
            $paymenttype = $this->getRequest()->getPost('resulttype');
            $typeId = $this->getRequest()->getPost('resortId');
            $startdate = $this->getRequest()->getPost('strdate');
            $enddate = $this->getRequest()->getPost('enddate');
            $resultset = array('collection' => $this->model->getprofitCollection($paymenttype,$typeId, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
        }
//        d($resultset);
        $filename = $filename . "_" . date("d-M-Y H:i:s") . ".csv";
        $view = new ViewModel();

        $view->setTemplate('download/download-csv-profitloss')
                ->setVariable('results', $resultset)
                ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(
                    'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                ->get('viewrenderer')
                ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(
                        'Content-Disposition', sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);
        //d($response);
        return $response;
    }

}
