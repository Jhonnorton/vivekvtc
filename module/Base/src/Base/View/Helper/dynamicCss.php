<?php
namespace  Application\View\Helper;
 
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Router\Http\RouteMatch;

 
 
class dynamicCss extends AbstractHelper
{

    public function __construct()
    {

    }
    public function __invoke($data)
    {
        $view = new ViewModel();
        $view = $this->getView()->render('application/website/dynamiccss.phtml', array("color"=>$data));
        return $view;
     }
}

?>