<?php

namespace Resources\Form;

class ImgUploadForm extends \Zend\Form\Form {

    public function __construct($name = NULL, $options = array()) {


        // we want to ignore the name passed
        parent::__construct('test', $options);

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type' => 'file',
                'accept' => 'image/*',
            ),
            'options' => array(
                'label' => 'Image Upload',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Ok',
                'id' => 'submitbutton',
            ),
        ));
    }

}
