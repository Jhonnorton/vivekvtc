<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpPostmeta
 *
 * @ORM\Table(name="wp_postmeta", indexes={@ORM\Index(name="post_id", columns={"post_id"}), @ORM\Index(name="meta_key", columns={"meta_key"})})
 * @ORM\Entity
 */
class WpPostmeta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="meta_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $metaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_id", type="bigint", nullable=false)
     */
    private $postId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", length=255, nullable=true)
     */
    private $metaKey;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_value", type="text", nullable=true)
     */
    private $metaValue;



    /**
     * Get metaId
     *
     * @return integer 
     */
    public function getMetaId()
    {
        return $this->metaId;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     * @return WpPostmeta
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set metaKey
     *
     * @param string $metaKey
     * @return WpPostmeta
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    /**
     * Get metaKey
     *
     * @return string 
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * Set metaValue
     *
     * @param string $metaValue
     * @return WpPostmeta
     */
    public function setMetaValue($metaValue)
    {
        $this->metaValue = $metaValue;

        return $this;
    }

    /**
     * Get metaValue
     *
     * @return string 
     */
    public function getMetaValue()
    {
        return $this->metaValue;
    }
}
