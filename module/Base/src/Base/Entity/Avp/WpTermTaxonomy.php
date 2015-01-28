<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpTermTaxonomy
 *
 * @ORM\Table(name="wp_term_taxonomy", uniqueConstraints={@ORM\UniqueConstraint(name="term_id_taxonomy", columns={"term_id", "taxonomy"})}, indexes={@ORM\Index(name="taxonomy", columns={"taxonomy"})})
 * @ORM\Entity
 */
class WpTermTaxonomy
{
    /**
     * @var integer
     *
     * @ORM\Column(name="term_taxonomy_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $termTaxonomyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="term_id", type="bigint", nullable=false)
     */
    private $termId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="taxonomy", type="string", length=32, nullable=false)
     */
    private $taxonomy = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="bigint", nullable=false)
     */
    private $parent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="bigint", nullable=false)
     */
    private $count = '0';



    /**
     * Get termTaxonomyId
     *
     * @return integer 
     */
    public function getTermTaxonomyId()
    {
        return $this->termTaxonomyId;
    }

    /**
     * Set termId
     *
     * @param integer $termId
     * @return WpTermTaxonomy
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;

        return $this;
    }

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
     * Set taxonomy
     *
     * @param string $taxonomy
     * @return WpTermTaxonomy
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Get taxonomy
     *
     * @return string 
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return WpTermTaxonomy
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return WpTermTaxonomy
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return WpTermTaxonomy
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }
}
