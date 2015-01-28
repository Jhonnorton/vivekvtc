<?php

namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class ToursController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        $this->model = $this->getModel('Tours');
        if ($this->params()->fromRoute('id', 0)) {
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);
    }

    public function indexAction() {



        return $this->getView(array(
                    'collection' => $this->model->getCollection(),
                    'message' => $this->getPageMessages(),
        ));
    }

    public function tourlocationAction() {

        return $this->getView(array(
                    'collection' => $this->model->getLocationView($this->_id),
                    'id' => $this->_id,
                    'message' => $this->getPageMessages(),
        ));
    }

    public function locationAddAction() {

        $form = new \Inventory\Form\LocationForm($this->getEm(), '\Base\Entity\TourLocations');


        if ($this->request->isPost()) {
            //d($this->_id);
            $data = $this->request->getPost();

            $form->setData($data);

            if ($this->model->isValidModel($form)) {


                $object = array('object' => $this->request->getPost(),);
                //d($object);
                $this->model->locationsave($object);
                $this->addPageMessage('Tour location has been added.', 'success');
                // d('success');
                $this->redirect()->toRoute('tour-location', array('id' => $this->_id));
            }
        }


        $data = $this->getEm()->find('Base\Entity\Tours', $this->_id);



        $view = $this->getView(array(
            'form' => $form, 'data' => $data, 'id' => $this->_id,
        ));
        return $view;
    }

    public function locationEditAction() {

        $data = $this->getEm()->find('Base\Entity\TourLocations', $this->_id);
        $tourid = $data->getTourId()->getId();
        $form = new \Inventory\Form\LocationForm($this->getEm(), $data);
        if ($this->request->isPost()) {
            $data1 = $this->request->getPost();
            $form->setData($data1);
            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),);
                $this->model->locationupdate($object);
                $this->addPageMessage('Tour location has been updated.', 'success');
                $this->redirect()->toRoute('tour-location', array('id' => $tourid));
            }
        }

        $view = $this->getView(array(
            'form' => $form,
            'id' => $this->_id,
            'data' => $data,
        ));
        return $view;
    }

    public function locationDeleteAction() {

        $data = $this->getEm()->find('Base\Entity\TourLocations', $this->_id);

        $this->model->locationdelete($this->_id);

        $this->addPageMessage('The Location has been deleted.', 'success');
        $this->redirect()->toRoute('tour-location', array('id' => $data->getTourId()->getId()));
    }

    public function locationResortsAction() {
        return $this->getView(array(
                    'collection' => $this->model->getLocationResorts($this->_id),
                    'message' => $this->getPageMessages(),
                    'id' => $this->_id,
        ));
    }

    public function locationResortsAddAction() {

        $form = new \Inventory\Form\AddResortForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\TourResorts');
        $data = $this->getEm()->find('Base\Entity\TourLocations', $this->_id);
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $dataform = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $dataform['image'] = $files['image']['name'];
            }
            if ($this->model->isValidModel($form) && $this->model->isValidImage($form, $files)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->resortsave($object);
                // $this->_session->getManager()->getStorage()->clear('image');
                $this->addPageMessage('The resort has been added.', 'success');
                $this->redirect()->toRoute('tour-location-resorts', array('id' => $data->getId()));
            }
        }

        //d($data);
        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id, 'data' => $data,
        ));
        return $view;
    }

    public function resortDeleteAction() {

        $data = $this->getEm()->find('Base\Entity\TourResorts', $this->_id);

        $this->model->resortdelete($this->_id);

        $this->addPageMessage('The resort for this tour has been deleted.', 'success');
        $this->redirect()->toRoute('tour-location-resorts', array('id' => $data->getLocationId()->getId()));
    }

    public function resortActiveAction() {

        $data = $this->getEm()->find('Base\Entity\TourResorts', $this->_id);
        //  d($data);
        $this->model->setresortactive($this->_id);

        $this->addPageMessage('The resort has been activated.', 'success');
        $this->redirect()->toRoute('tour-location-resorts', array('id' => $data->getLocationId()->getId()));
    }

    public function resortInActiveAction() {


        $data = $this->getEm()->find('Base\Entity\TourResorts', $this->_id);
        //  d($data);
        $this->model->setresortinactive($this->_id);

        $this->addPageMessage('The resort has been Deactivated.', 'success');
        $this->redirect()->toRoute('tour-location-resorts', array('id' => $data->getLocationId()->getId()));
    }

    public function locationResortRoomsAction() {
        $locationid = $this->params()->fromRoute('locationid', null);
        return $this->getView(array(
                    'collection' => $this->model->getLocationResortRooms($locationid, $this->_id),
                    'message' => $this->getPageMessages(),
                    'id' => $this->_id,
                    'locationid' => $locationid,
        ));
    }

    public function locationResortRoomsAddAction() {
        $locationid = $this->params()->fromRoute('locationid', null);
        $form = new \Inventory\Form\AddResortRoomForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryTourRooms');
        // $data = $this->getEm()->find('Base\Entity\TourResorts',array()id);

        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $dataform = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $dataform['image'] = $files['image']['name'];
            }
            // d($dataform);
            if ($this->model->isValidModel($form) && $this->model->isValidImage($form, $files)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->resortroomsave($object);
                // $this->_session->getManager()->getStorage()->clear('image');
                $this->addPageMessage('The resort room has been added.', 'success');
                $this->redirect()->toRoute('tour-location-resort-rooms', array('locationid' => $locationid, 'id' => $this->_id));
            }
        }

//     d($data);
        $collection = $this->model->getroom($this->_id);

        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id, 'data' => $collection, 'locationid' => $locationid,
        ));
        return $view;
    }

    public function locationResortRoomsEditAction() {

        $data = $this->getEm()->find('\Base\Entity\InventoryTourRooms', $this->_id);
        $locationid = $data->getlocationId()->getId();
        $resortid = $data->getResortId()->getId();
        $form = new \Inventory\Form\AddResortRoomForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $data);

        if ($this->request->isPost()) {
            $data1 = $this->request->getPost();
            $form->setData($data1);
            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),);
                // d($object);
                $this->model->resortroomupdate($object);
                $this->addPageMessage('Resort room has been updated.', 'success');
                $this->redirect()->toRoute('tour-location-resort-rooms', array('locationid' => $locationid, 'id' => $resortid));
            }
        }
        //  d($data);
        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id, 'data' => $data
        ));
        return $view;
    }

    public function resortRoomsDeleteAction() {

        $data = $this->getEm()->find('\Base\Entity\InventoryTourRooms', $this->_id);
        $locationid = $data->getlocationId()->getId();
        $resortid = $data->getResortId()->getId();

        $this->model->resortroomdelete($this->_id);

        $this->addPageMessage('The resort room for this tour has been deleted.', 'success');
        $this->redirect()->toRoute('tour-location-resort-rooms', array('locationid' => $locationid, 'id' => $resortid));
    }

    public function resortRoomsActiveAction() {

        $data = $this->getEm()->find('\Base\Entity\InventoryTourRooms', $this->_id);
        //  d($data);
        $locationid = $data->getlocationId()->getId();
        $resortid = $data->getResortId()->getId();

        $this->model->setresortroomactive($this->_id);

        $this->addPageMessage('The resort room has been activated.', 'success');
        $this->redirect()->toRoute('tour-location-resort-rooms', array('locationid' => $locationid, 'id' => $resortid));
    }

    public function resortRoomsInActiveAction() {


        $data = $this->getEm()->find('\Base\Entity\InventoryTourRooms', $this->_id);
        //  d($data);
        $locationid = $data->getlocationId()->getId();
        $resortid = $data->getResortId()->getId();

        $this->model->setresortroominactive($this->_id);

        $this->addPageMessage('The resort room has been Deactivated.', 'success');
        $this->redirect()->toRoute('tour-location-resort-rooms', array('locationid' => $locationid, 'id' => $resortid));
    }

}
