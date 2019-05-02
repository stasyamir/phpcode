<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductType
 *
 * @ORM\Table(name="product_type")
 * @ORM\Entity
 */
class ProductType
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
     * @ORM\Column(name="names", type="string", length=255, nullable=false)
     */
    private $names;

    /**
     * @return string
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param string $names
     */
    public function setNames($names)
    {
        $this->names = $names;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


}

