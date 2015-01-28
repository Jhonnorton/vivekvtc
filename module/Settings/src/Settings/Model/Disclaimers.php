<?php

namespace Settings\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class Disclaimers extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $models = null;


    public function __construct($serviceManager, $targetEntity = false) {
        parent::__construct($serviceManager, $targetEntity);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function isValidModel($form) {

        return true;
    }

    public function getCollection() {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Disclaimers', 'er');
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
    }
    
    public function saveDisclaimer($data){
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Disclaimers();
        $entity->setTitle($data['title']);
        $entity->setDescription($data['description']);
        $entity->setCreated(new \DateTime);
        $entity->setUpdated(new \DateTime);
//        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
    
    public function getDisclaimerData($id) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Disclaimers', 'er')
                ->where('er.id='.$id);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        
        return $collection;
    }
    
    public function editDisclaimer($data){
        $em = $this->getEntityManager();
        $entity = $em->find('\Base\Entity\Disclaimers', (int) $data['id']);
        $entity->setTitle($data['title']);
        $entity->setDescription($data['description']);
        $entity->setUpdated(new \DateTime);
//        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}