<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="expense")
 * @ORM\Entity
 */

class Expense extends Base\BaseEntity
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
     * @var \Base\Entity\ExpenseCategory
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\ExpenseCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expense_category_id", referencedColumnName="id")
     * })
     */
    private $expenseCategoryId;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $updated;
    
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
     * Set expenseCategoryId
     *
     * @param integer $expenseCategoryId
     * @return Expense
     */
    public function setExpenseCategoryId($expenseCategoryId) {
        $this->expenseCategoryId = $expenseCategoryId;

        return $this;
    }

    /**
     * Get expenseCategoryId
     *
     * @return integer 
     */
    public function getExpenseCategoryId() {
        return $this->expenseCategoryId;
    }
    /**
     * Set amount
     *
     * @param integer $amount
     * @return Expense
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount() {
        return $this->amount;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Expense
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Expense
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }
    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Expense
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated() {
        return $this->updated;
    }
}