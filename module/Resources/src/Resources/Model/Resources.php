<?php
 
namespace Resources\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

use Zend\Mvc\MvcEvent;


class Resources extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
                $inputFilter = new InputFilter();
                $factory     = new InputFactory();


                $inputFilter->add($factory->createInput(array(
                                'name'     => 'name',
                                'required' => true,
                                'filters'  => array(
                                                array('name' => 'StripTags'),
                                                array('name' => 'StringTrim'),
                                ),
                                'validators' => array(
                                                array(
                                                                'name'    => 'StringLength',
                                                                'options' => array(
                                                                                'encoding' => 'UTF-8',
                                                                                'min'      => 2,
                                                                                'max'      => 128,
                                                                ),
                                                ),
                                ),
                )));

                $inputFilter->add($factory->createInput(array(
                                'name'     => 'image',
                                'required' => false,
                                'filters'  => array(							
                                                array('name' => 'StringTrim'),
                                ),
                                'validators' => array(
                                                array(
                                                                'name'    => 'StringLength',
                                                                'options' => array(
                                                                                'encoding' => 'UTF-8',
                                                                                'max'      => 50,
                                                                ),
                                                ),
                                ),
                )));

                $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function update($resources){        
        $resources = $resources = $this->updateResources($resources);        
        $repository = $this->getEntityManager()->getRepository('Base\Entity\Role');
        $role = $repository->findOneBy(array('id'=>1));        
        $count = $this->saveAllResources($resources, $role);        
        return $count;		
    }	

    public function getAllResources(MvcEvent $e){
        $exceptions = array('0','doctrine_orm_module_yuml', 'home', 'application', 'base');
        $resourses = array();
        $config = $e->getApplication()->getServiceManager()->get('COnfig');
        $routes = $config['router']['routes'];
        foreach ($routes as $name => $routeConfig){
                if(array_search($name, $exceptions))
                        continue;
                $resourses[] = $name;
        }        
        return $resourses;
    }  
    
    public function updateResources(array $resources){        
        $arr = array();        
        $repository = $this->getEntityManager()->getRepository('Base\Entity\Resource');
        $collection = $repository->findAll();
        $em = $this->getEntityManager();
        foreach ($collection as $resource){
            if(!in_array($resource->getName(), $resources)){                                                               
                $em->remove($resource);
            }else{
                $arr[] = $resource->getName();
            }
        }        
        $em->flush();           
        return array_diff($resources, $arr);
    }
    
    public function saveAllResources(array $resources, \Base\Entity\Role $role ) {                
        $count = 0;
        if($resources && $role){            
            foreach ($resources as $name){
                $object = new \Base\Entity\Resource();                        
                $object->setName($name);            
                parent::save($object);  
                $permission = new \Base\Entity\Permissions();      
                $permission->setResource($object);
                $permission->setRole($role);
                $permission->setPermission(1);
                parent::save($permission);
                $count++;
            }
        } 
        return $count;
    }        
} 