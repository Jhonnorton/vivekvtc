<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaigns
 *
 * @ORM\Table(name="campaigns")
 * @ORM\Entity
 */
class Campaigns
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
     * @ORM\Column(name="template_id", type="integer", nullable=false)
     */
    private $templateId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=true)
     */
    private $addedOn;



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
     * Set templateId
     *
     * @param integer $templateId
     * @return Campaigns
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * Get templateId
     *
     * @return integer 
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Campaigns
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return Campaigns
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime 
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }
}
