<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelsRating
 *
 * @ORM\Table(name="hotels_rating")
 * @ORM\Entity
 */
class HotelsRating
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    private $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer", nullable=false)
     */
    private $ratingId;



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
     * Set resortId
     *
     * @param integer $resortId
     * @return HotelsRating
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return HotelsRating
     */
    public function setRatingId($ratingId)
    {
        $this->ratingId = $ratingId;

        return $this;
    }

    /**
     * Get ratingId
     *
     * @return integer 
     */
    public function getRatingId()
    {
        return $this->ratingId;
    }
}
