<?php

namespace FeedReader\Dataprovider\Assortment\DataSource\JsonFeed;

use FeedReader\Dataprovider\Assortment\DataSource\IMapper;
use FeedReader\Dataprovider\Assortment\Tools\EnumMappingTool;

/**
 * Class Mapper
 * @package FeedReader\Dataprovider\ProductProvider\DataSource\JsonFeed
 */
final class Mapper implements IMapper
{
    private $mapping = [
        "id" => "PRODUCT_IDENTIFIER",
        "gtin" => "EAN_CODE_GTIN",
        "manufacturer" => "BRAND",
        "name" => "NAME",
        "packaging" => "PACKAGE",
        "baseProductPackaging" => "VESSEL",
        "baseProductUnit" => "VESSEL",
        "baseProductAmount" => "LITERS_PER_BOTTLE",
        "baseProductQuantity" => "BOTTLE_AMOUNT",
    ];

    /**
     * @return array
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    public function getMappingFunctionSet()
    {
        return
            [
            'packaging' => function ($v) {
                $v = strtolower($v);

                $mapped = EnumMappingTool::map('packaging', $v);
                if (is_null($mapped)) {//var_dump(is_null($v));die();
                    throw new \Exception('Cann\' map packaging in input Json');
                }

                return $mapped;
            },

            "baseProductPackaging" => function ($v) {
                $mapped = EnumMappingTool::map('baseProductPackaging', $v);
                if (is_null($mapped)) {
                    throw new \Exception('Cann\' map baseProductPackaging in input Json');
                }

                return $mapped;
            },

            "baseProductUnit" => function ($v) {
                $mapped = EnumMappingTool::map('baseProductUnit', 'liters');
                if (is_null($mapped)) {
                    throw new \Exception('Cann\' map baseProductUnit in input Json');
                }
            },

            "baseProductAmount" => function ($v) {
                $v = str_replace(',', '.', $v);
                return floatval($v);
            },

            "baseProductQuantity" => function ($v) {
                return intval($v);
            },
        ];
    }
}
