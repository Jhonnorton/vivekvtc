<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpSkysaApps
 *
 * @ORM\Table(name="wp_skysa_apps")
 * @ORM\Entity
 */
class WpSkysaApps
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
     * @var string
     *
     * @ORM\Column(name="app_id", type="string", length=150, nullable=false)
     */
    private $appId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bar_label", type="string", length=255, nullable=false)
     */
    private $barLabel = '';

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="string", length=255, nullable=false)
     */
    private $option1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="string", length=255, nullable=false)
     */
    private $option2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="string", length=255, nullable=false)
     */
    private $option3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="option4", type="string", length=8126, nullable=false)
     */
    private $option4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="align", type="string", length=50, nullable=false)
     */
    private $align = '';

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=8126, nullable=false)
     */
    private $icon = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="order_by", type="smallint", nullable=false)
     */
    private $orderBy = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="smallint", nullable=false)
     */
    private $width = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="smallint", nullable=false)
     */
    private $height = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=20, nullable=false)
     */
    private $position = '';



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
     * Set appId
     *
     * @param string $appId
     * @return WpSkysaApps
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * Get appId
     *
     * @return string 
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WpSkysaApps
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
     * Set barLabel
     *
     * @param string $barLabel
     * @return WpSkysaApps
     */
    public function setBarLabel($barLabel)
    {
        $this->barLabel = $barLabel;

        return $this;
    }

    /**
     * Get barLabel
     *
     * @return string 
     */
    public function getBarLabel()
    {
        return $this->barLabel;
    }

    /**
     * Set option1
     *
     * @param string $option1
     * @return WpSkysaApps
     */
    public function setOption1($option1)
    {
        $this->option1 = $option1;

        return $this;
    }

    /**
     * Get option1
     *
     * @return string 
     */
    public function getOption1()
    {
        return $this->option1;
    }

    /**
     * Set option2
     *
     * @param string $option2
     * @return WpSkysaApps
     */
    public function setOption2($option2)
    {
        $this->option2 = $option2;

        return $this;
    }

    /**
     * Get option2
     *
     * @return string 
     */
    public function getOption2()
    {
        return $this->option2;
    }

    /**
     * Set option3
     *
     * @param string $option3
     * @return WpSkysaApps
     */
    public function setOption3($option3)
    {
        $this->option3 = $option3;

        return $this;
    }

    /**
     * Get option3
     *
     * @return string 
     */
    public function getOption3()
    {
        return $this->option3;
    }

    /**
     * Set option4
     *
     * @param string $option4
     * @return WpSkysaApps
     */
    public function setOption4($option4)
    {
        $this->option4 = $option4;

        return $this;
    }

    /**
     * Get option4
     *
     * @return string 
     */
    public function getOption4()
    {
        return $this->option4;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return WpSkysaApps
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return WpSkysaApps
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set align
     *
     * @param string $align
     * @return WpSkysaApps
     */
    public function setAlign($align)
    {
        $this->align = $align;

        return $this;
    }

    /**
     * Get align
     *
     * @return string 
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return WpSkysaApps
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return WpSkysaApps
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return WpSkysaApps
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return WpSkysaApps
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return WpSkysaApps
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
