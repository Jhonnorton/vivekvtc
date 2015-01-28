<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpTerms
 *
 * @ORM\Table(name="wp_terms", uniqueConstraints={@ORM\UniqueConstraint(name="slug", columns={"slug"})}, indexes={@ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class WpTerms
{
    /**
     * @var integer
     *
     * @ORM\Column(name="term_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $termId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="term_group", type="bigint", nullable=false)
     */
    private $termGroup = '0';



    /**
     * Get termId
     *
     * @return integer 
     */
    public function getTermId()
    {
        return $this->termId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WpTerms
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return WpTerms
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set termGroup
     *
     * @param integer $termGroup
     * @return WpTerms
     */
    public function setTermGroup($termGroup)
    {
        $this->termGroup = $termGroup;

        return $this;
    }

    /**
     * Get termGroup
     *
     * @return integer 
     */
    public function getTermGroup()
    {
        return $this->termGroup;
    }
}
