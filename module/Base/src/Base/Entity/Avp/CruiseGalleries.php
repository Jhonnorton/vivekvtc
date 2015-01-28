<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseGalleries
 *
 * @ORM\Table(name="cruise_galleries")
 * @ORM\Entity
 */
class CruiseGalleries
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
     * @var integer
     *
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    private $cruiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    private $image;



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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return CruiseGalleries
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return CruiseGalleries
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
