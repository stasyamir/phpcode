<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_produck_type", columns={"product_type"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var \AppBundle\Entity\ProductType
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_type", referencedColumnName="id")
     * })
     */
    private $productType;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return ProductType
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param ProductType $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}

