<?php
 
namespace Users\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

use Base;


class Acl extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
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
                                                            'min'      => 4,
                                                            'max'      => 64,
                                            ),
                                    ),
                    ),
            )));

            $inputFilter->add($factory->createInput(array(
                    'name'     => 'isActive',
                    'required' => true,
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
    
    public function saveModel(Base\Entity\Role $role, array $resources){                        
        $role = parent::save($role);
        $repository = $this->getEntityManager()->getRepository('Base\Entity\Resource');
        foreach ($resources as $resourceId){
            $object = new \Base\Entity\Permissions();
            $resource = $repository->findOneBy(array('id' => (int)$resourceId));            
            $object->setResource($resource);
            $object->setRole($role);
            $object->setPermission(1);
            //$object->setPermission(1);
            parent::save($object);
        }                
    }
    
    public function update(Base\Entity\Role $role, array $resources){        
        $resources = $this->updateRolePermissions($role, $resources);
        $this->saveModel($role, $resources);
    }

    protected function updateRolePermissions($role = null, array $resources){        
        $arr = array();
        $repository = $this->getEntityManager()->getRepository('Base\Entity\Permissions');
        if(is_null($role)) return $permissions;
        $collection = $repository->findBy(array('role' => $role)); 
        $em = $this->_entityManager;
        
     //   d($collection);
        
        foreach ($collection as $permission){
            if(!in_array($permission->getResource()->getId(), $resources) && $permission->getResource()->getStatus()==1){ 
             
                $em->remove($permission);
            }else{
                $arr[] = $permission->getResource()->getId();
            }
        }
        $em->flush();               
        return array_diff($resources, $arr);
    }    

    public function getPermissions($id = null){            
        $repository = $this->getEntityManager()->getRepository('Base\Entity\Permissions');
        if(is_null($id)) return $repository->findBy(array('permission' => 1));            
        return $repository->findBy(array('id' => (int)$id, 'permission' => 1));
    }

    public function setResources(array $resourses){



            foreach ($resourses as $resource){

                    $entity = new \Base\Entity\Resource();

                    $entity->setName($resource);
                    $this->save($entity);

                    unset($entity);

            }

    }

    public function saveAcl(Base\Entity\Role $role, array $permissions){

            $em = $this->_entityManager;

            $em->persist($role);
            $em->flush();

            $permissions = $this->getPermissionsArray($permissions);

            $collection = $em->getRepository('Base\Entity\Permissions')->findBy(array('role' => $role->getId()));

            //d($colection);

            if(count($collection) > 0){

                    foreach ($collection as $item){



                            if(!array_key_exists($item->getResource()->getId(), $permissions)) continue;



                            $item->setPermission($permissions[$item->getResource()->getId()]);
                            $em->persist($item);
                            $em->flush();

                    }
            } else {

                    $this->setPermissions($role, $permissions);

            }
    }


    public function getPermissionsArray(array $allowPermissions){



            $permissions = array();

            $resources = $this->_entityManager
                                              ->getRepository('Base\Entity\Resource')
                                              ->findAll(); 	
                                                    ;

            foreach ($resources as $resource){



                    $permissions[$resource->getId()] = in_array($resource->getId(), $allowPermissions)? 1: 0;

            }

            return $permissions;
    }

    public function setPermissions(Base\Entity\Role $role, array $permissions){

        $repository = $this->_entityManager->getRepository('Base\Entity\Resource');

        foreach ($permissions as $resourceId => $permission){

            $resource = $repository->findOneBy(array('id' => (int)$resourceId));

            if(is_null($resource)) continue;

            $object = new \Base\Entity\Permissions();

            $object->setResource($resource);
            $object->setRole($role);
            $object->setPermission($permission);

            $this->_entityManager->persist($object);
            $this->_entityManager->flush();

        }		
    }

    protected function isValidName($object){
        if($this->checkItem(array('name'=>$object->getData()->getName()))){
                $object->get('name')->setMessages(array('Role with this name already exists'));
                return false;
        }
        return true;
    }

    public function isValidModel($object){
        return $this->isValidName($object);
    }

    public function isValidModelOnEdit($object){
        if($this->checkItem(array(
                'id'=>$object->getData()->getId(),
                'name'=>$object->getData()->getName()))
        ){
                return true;
        }
        return $this->isValidName($object);
    }
    
    
    public function getModuleName(){
        //$repository = $this->_entityManager->getRepository('Base\Entity\Modules');
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
           $qb->select('p')
            ->from('\Base\Entity\Resource', 'p')
            ->leftJoin('p.module','er');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        
      //  $permission=$repository->findAll();
 /*d($collection);
        echo "<pre>";
        print_r($collection);
   */     return $collection;
 
                   
    }
    
    
     public function getUser(){
        //$repository = $this->_entityManager->getRepository('Base\Entity\Modules');
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
           $qb->select(array('p','count(p.role) as count_role'))
            ->from('\Base\Entity\Users', 'p')
            ->leftJoin('p.role','er')
            ->groupby('p.role');
           
            $query = $qb->getQuery();
            //d($query->getsql());
            
            $collection = $query->getResult();
          //  d($collection);
          //  echo "<pre>";
          //  print_r($collection);die;
        
        return $collection;
   //d()
 
                   
    }
    
     public function suspend($id){        
          
            $item = $this->getItem($id);
            
           // d($item);
            if ($item) {
                if($item->getIsActive()==1){
                $item->setIsActive('0');
              
                }else{
                        $item->setIsActive('1');
                }
                  parent::save($item);
            }
    
    }

    
} 
