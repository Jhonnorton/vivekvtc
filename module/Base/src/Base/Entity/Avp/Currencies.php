<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currencies
 *
 * @ORM\Table(name="currencies")
 * @ORM\Entity
 */
class Currencies
{
    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $currency = '';

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $rate = '0';



    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return Currencies
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }
}
