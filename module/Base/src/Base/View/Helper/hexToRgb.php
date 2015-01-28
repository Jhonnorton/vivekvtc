<?php
namespace  Application\View\Helper;

use Zend\View\Helper\AbstractHelper;


 
 
class hexToRgb extends AbstractHelper
{   protected $color;

    public function __construct()
    {

    }
    public function __invoke($colour=null)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        
        return "rgba($r,$g,$b,0)";
    }
}

?>