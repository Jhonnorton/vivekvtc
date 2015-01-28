<?php

namespace Base\Model\Plugins;

class Imagine {

    public static $imagine;
    public static $options = array();
    public static $image;    
    //public static $srcDestination = '/home/vpadmin/rm.avp.image/img/user_uploads/'; // PRODACTION!!!!!!!!
    //public static $imagesBaseUrl = 'http://img.vacationparties.com/img/user_uploads/'; //PRODACTION
    
    public static $srcDestination = '/home/isteam/public_html/rmv/public/img/user_uploads/'; // Development staging!!!!!!!!
    public static $imagesBaseUrl = 'http://192.155.246.146:9065/img/user_uploads/'; //Development Staging
    
    public static $destination = '';
    
    
    public static function getInstance($image, $options = array()) {

        self::$image = $image;

        self::$imagine = new \Imagine\Gd\Imagine();

        if (is_array($options))
            self::$options = $options;

        return self::$image = self::$imagine->open(self::$image);
    }

    public static function resizeImage($options = array(), $mode = null, \Imagine\Gd\Imagine $image = null) {

        if ($options)
            self::$options = $options;

        if ($image)
            self::$image = $image;

        //d(self::$options);

        if (!array_key_exists('width', self::$options) || !array_key_exists('height', self::$options))
            throw new \Exception('Invalid options to resize image');

        $size = new \Imagine\Image\Box(self::$options['width'], self::$options['height']);

        if (!$mode) {
            $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        } else {
            $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        }

        return self::$image = self::$image->thumbnail($size, $mode);
    }

    public static function _save($name, $destination = null, \Imagine\Gd\Imagine $image = null) {

        if ($destination)
            self::$destination = $destination;

        if ($image)
            self::$image = $image;

        return self::$image = self::$image->save(self::$srcDestination . self::$destination . $name);
    }

    public static function uploadImage($tmpName, $imageName, $options = null, $destination = null) {

        self::getInstance($tmpName);
        if ($options) {
            self::resizeImage($options);
        }
        self::_save($imageName, $destination);

        return $imageName;
    }

}
