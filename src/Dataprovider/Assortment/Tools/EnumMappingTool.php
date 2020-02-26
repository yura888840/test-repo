<?php

namespace FeedReader\Dataprovider\Assortment\Tools;

/**
 * Class EnumMappingTool
 * @package FeedReader\Dataprovider\Assortment\Tools
 */
class EnumMappingTool
{
    /**
     * @var array Mapping fieldNam => source => MappedDestination
     */
    private static $mappings = [
        'packaging' => [
            'case'      => 'CA',
            'box'       => 'BX',
            'bottle'    => 'BO',
        ],
        'baseProductUnit' => [
            'liters'    => 'LT',
            'grams'     => 'GR'
        ],
        'baseProductPackaging' => [
            'bottle'    => 'BO',
            'can'       => 'CN'
        ]
    ];

    /**
     * @param string $type
     * @param string $valueToMap
     * @return string|null
     */
    public static function map(string $type, string $valueToMap) : ?string
    {
        if (self::keyNotPresent($type, $valueToMap)) {
            return null;
        }

        return static::$mappings[$type][$valueToMap];
    }

    /**
     * @param string $type
     * @param string $valueToMap
     * @return bool
     */
    private static function keyNotPresent(string $type, string $valueToMap)
    {
        if (!array_key_exists($type, static::$mappings)
            || !array_key_exists($valueToMap, static::$mappings[$type])
        ) {
            return true;
        }

        return false;
    }
}
