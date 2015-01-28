<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSlider
 *
 * @ORM\Table(name="homepage_slider")
 * @ORM\Entity
 */
class HomepageSlider
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
     * @ORM\Column(name="file", type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_video", type="string", length=255, nullable=true)
     */
    private $youtubeVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=128, nullable=false)
     */
    private $link = 'javascript:void(0);';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=true)
     */
    private $sortOrder;



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
     * Set file
     *
     * @param string $file
     * @return HomepageSlider
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set youtubeVideo
     *
     * @param string $youtubeVideo
     * @return HomepageSlider
     */
    public function setYoutubeVideo($youtubeVideo)
    {
        $this->youtubeVideo = $youtubeVideo;

        return $this;
    }

    /**
     * Get youtubeVideo
     *
     * @return string 
     */
    public function getYoutubeVideo()
    {
        return $this->youtubeVideo;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return HomepageSlider
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return HomepageSlider
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
     * Set sortOrder
     *
     * @param integer $sortOrder
     * @return HomepageSlider
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer 
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}
