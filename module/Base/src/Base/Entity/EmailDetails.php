<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailDetails
 *
 * @ORM\Table(name="email_details")
 * @ORM\Entity
 */
class EmailDetails extends Base\BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="text", nullable=false)
     */
    public $header;

    /**
     * @var string
     *
     * @ORM\Column(name="footer", type="text", nullable=false)
     */
    public $footer;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    public $message;
    
    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=true)
     */
    protected $template;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="action", type="integer", nullable=true)
     */
    protected $action;

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
     * Set name
     *
     * @param string $name
     * @return EmailDetails
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
     * Set header
     *
     * @param string $header
     * @return EmailDetails
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set footer
     *
     * @param string $footer
     * @return EmailDetails
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return string 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return EmailDetails
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
                
    }
    
    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate() {
        
        return $this->template;
    }
    
    /**
     * Set template
     *
     * @param string $template
     * @return EmailDetails
     */
    public function setTemplate($template) {
        
        $this->template = $template;
        
        return $this;
    }
    
    /**
     * Get action
     *
     * @return integer 
     */
    public function getAction() {
        
        return $this->action;
    }

    /**
     * Set action
     *
     * @param integer $action
     * @return EmailDetails
     */
    public function setAction($action) {
        
        $this->action = $action;
        
        return $this;
    }
}
