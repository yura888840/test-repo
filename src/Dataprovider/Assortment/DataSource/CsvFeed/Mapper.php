<?php

namespace FeedReader\Dataprovider\Assortment\DataSource\CsvFeed;

use FeedReader\Dataprovider\Assortment\DataSource\IMapper;
use FeedReader\Dataprovider\Assortment\Tools\EnumMappingTool;

/**
 * Class Mapper
 * @package FeedReader\Dataprovider\Assortment\DataSource\CsvFeed
 */
final class Mapper implements IMapper
{
    protected $mapping = [
        "id" => "id",
        "gtin" => "ean",
        "manufacturer" => "manufacturer",
        "name" => "product",
        "packaging" => "packaging product",
        "baseProductPackaging" => "packaging unit",
        "baseProductUnit" => "amount per unit",
        "baseProductAmount" => "amount per unit",
        "baseProductQuantity" => "packaging product",
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
                if (false !== strpos($v, ' ')) {
                    $v = substr($v, 0, strpos($v, ' '));
                }
                if ('single' == $v) {
                    $v = 'bottle';
                }

                $mapped = EnumMappingTool::map('packaging', $v);
                if (is_null($mapped)) {
                    throw new \Exception('Cann\' map packaging in input CSV');
                }

                return $mapped;
            },

            "baseProductPackaging" => function ($v) {
                $mapped = EnumMappingTool::map('baseProductPackaging', $v);
                if (is_null($mapped)) {
                    throw new \Exception('Cann\' map baseProductPackaging in input CSV');
                }

                return $mapped;
            },

            "baseProductUnit" => function ($v) {

                $v = substr($v, -1);
                if ('l' == $v) {
                    $v = 'liters';
                }

                $mapped = EnumMappingTool::map('baseProductUnit', $v);
                if (is_null($mapped)) {
                    throw new \Exception('Cann\'t map baseProductUnit in input CSV');
                }

                return $mapped;
            },

            "baseProductAmount" => function ($v) {
                $v = substr($v, 0, -1);
                $v = str_replace(',', '.', $v);

                return floatval($v);
            },

            "baseProductQuantity" => function ($v) {
                if (false !== strpos($v, ' ')) {
                    $v = substr($v, strpos($v, ' ') + 1);
                }

                if ("single" == $v) {
                    $v = 1;
                }

                return intval($v);
            },
        ];
    }
}
