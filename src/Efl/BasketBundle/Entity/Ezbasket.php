<?php

namespace Efl\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ezbasket
 *
 * @ORM\Table(name="ezbasket", indexes={@ORM\Index(name="ezbasket_session_id", columns={"session_id"})})
 * @ORM\Entity
 */
class Ezbasket
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
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    private $orderId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="productcollection_id", type="integer", nullable=false)
     */
    private $productcollectionId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="session_id", type="string", length=255, nullable=false)
     */
    private $sessionId = '';



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
     * Set orderId
     *
     * @param integer $orderId
     * @return Ezbasket
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set productcollectionId
     *
     * @param integer $productcollectionId
     * @return Ezbasket
     */
    public function setProductcollectionId($productcollectionId)
    {
        $this->productcollectionId = $productcollectionId;

        return $this;
    }

    /**
     * Get productcollectionId
     *
     * @return integer 
     */
    public function getProductcollectionId()
    {
        return $this->productcollectionId;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return Ezbasket
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}