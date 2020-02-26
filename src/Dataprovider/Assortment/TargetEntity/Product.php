<?php

namespace FeedReader\Dataprovider\Assortment\TargetEntity;

use FeedReader\Dataprovider\Assortment\Product as IProduct;

class Product implements IProduct
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $gtin;

    /**
     * @var string
     */
    private $manufacturer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $packaging;

    /**
     * @var string
     */
    private $baseProductPackaging;

    /**
     * @var string
     */
    private $baseProductUnit;

    /**
     * @var float
     */
    private $baseProductAmount;

    /**
     * @var integer
     */
    private $baseProductQuantity;

    /**
     * Product constructor.
     * @param string $id
     * @param string $gtin
     * @param string $manufacturer
     * @param string $name
     * @param string $packaging
     * @param string $baseProductPackaging
     * @param string $baseProductUnit
     * @param float $baseProductAmount
     * @param int $baseProductQuantity
     */
    public function __construct(
        $id,
        $gtin,
        $manufacturer,
        $name, $packaging,
        $baseProductPackaging,
        $baseProductUnit,
        $baseProductAmount,
        $baseProductQuantity
    ) {
        $this->id = $id;
        $this->gtin = $gtin;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->packaging = $packaging;
        $this->baseProductPackaging = $baseProductPackaging;
        $this->baseProductUnit = $baseProductUnit;
        $this->baseProductAmount = $baseProductAmount;
        $this->baseProductQuantity = $baseProductQuantity;
    }


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * @return string
     */
    public function getBaseProductPackaging()
    {
        return $this->baseProductPackaging;
    }

    /**
     * @return string
     */
    public function getBaseProductUnit()
    {
        return $this->baseProductUnit;
    }

    /**
     * @return float
     */
    public function getBaseProductAmount()
    {
        return $this->baseProductAmount;
    }

    /**
     * @return int
     */
    public function getBaseProductQuantity()
    {
        return $this->baseProductQuantity;
    }
}
