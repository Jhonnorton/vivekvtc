<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 *
 * @ORM\Table(name="ratings")
 * @ORM\Entity
 */
class Ratings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stars", type="boolean", nullable=false)
     */
    private $stars;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set stars
     *
     * @param boolean $stars
     * @return Ratings
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars
     *
     * @return boolean 
     */
    public function getStars()
    {
        return $this->stars;
    }
}
