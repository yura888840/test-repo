<?php

namespace FeedReader\Dataprovider\Assortment;

use FeedReader\Dataprovider\Assortment\TargetEntity\Product;
use FeedReader\Dataprovider\Assortment\Product as IProduct;
use FeedReader\Dataprovider\Assortment\DataProvider;
use FeedReader\Dataprovider\DataSourceMapper;

/**
 * Class ProductDataProvider
 * @package FeedReader\Dataprovider\Assortment
 */
class ProductDataProvider implements DataProvider
{
    /**
     * @var \Iterator
     */
    private $dataSource;

    /**
     * @var DataSourceMapper
     */
    private $mapper;

    /**
     * ProductDataProvider constructor.
     * @param \Iterator $dataSource
     * @param DataSourceMapper $outputMapper
     */
    public function __construct(
        \Iterator $dataSource,
        DataSourceMapper $outputMapper
    ) {
        $this->mapper = $outputMapper;
        $this->dataSource = $dataSource;
    }

    /**
     * @return IProduct[]
     * @throws \Exception
     */
    public function getProducts(): array
    {
        $products = [];

        foreach ($this->dataSource as $rawProduct) {
            $item = $this->mapper->map($rawProduct);

            $products[] = new Product(
                $item['id'],
                $item['gtin'],
                $item['manufacturer'],
                $item['name'],
                $item['packaging'],
                $item['baseProductPackaging'],
                $item['baseProductUnit'],
                $item['baseProductAmount'],
                $item['baseProductQuantity']
            );
        }

        return $products;
    }
}
