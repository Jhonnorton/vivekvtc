<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Resources for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Resources\Controller;

use Zend\Mvc\MvcEvent;

class ResourcesController extends \Base\Controller\BaseController {

    protected $_entity = false;
    protected $allResources = null;

    public function onDispatch(MvcEvent $e) {

        //get all resources
        $this->model = $this->getModel('Resources');
        $this->allResources = $this->model->getAllResources($e);        
        $e->getViewModel()->setVariable('modulename', 'Resources');
        return parent::onDispatch($e);
    }

    public function indexAction() {
        $data = array();
        if ($this->request->isPost()) {
            $count = $this->model->update($this->allResources);
            $this->addPageMessage('Updating resources was successful! Updated '.$count.' resources', 'success');
            $data = array(
                'message' => $this->getPageMessages(),
            );
        }
        $view = $this->getView($data);
        return $view;
    }

    public function imguploadAction() {

        //d(__DIR__);

        $form = new \Resources\Form\ImgUploadForm();

        if ($this->request->isPost()) {
            $post = array_merge_recursive(
                    $this->request->getPost()->toArray(), $this->request->getFiles()->toArray()
            );

            if ($post['image']['name']) {

                $tmpName = $post['image']['tmp_name'];
                $name = $post['image']['name'];

                $image = \Base\Model\Plugins\Imagine::uploadImage($tmpName, $name, array('width' => 40, 'height' => 40), 'temp/images/');
            }
        }


        return $this->getView(array('form' => $form));
    }

}
//git commit