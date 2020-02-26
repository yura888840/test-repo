<?php

namespace FeedReader\Dataprovider\Assortment\DataSource;

/**
 * Class FeedFactory
 * @package FeedReader\Dataprovider\Assortment\DataSource
 */
class FeedFactory
{
    public static function getReader($type) : IReader
    {
        $class = sprintf("FeedReader\Dataprovider\Assortment\DataSource\%sFeed\Reader", ucfirst($type));
        if (!class_exists($class)) {
            throw new \Exception('Reader doesn\' exists');
        }

        return new $class;
    }

    public static function getMapper($type) : IMapper
    {
        $class = sprintf("FeedReader\Dataprovider\Assortment\DataSource\%sFeed\Mapper", ucfirst($type));
        if (!class_exists($class)) {
            throw new \Exception('Mapper doesn\' exists');
        }

        return new $class;
    }
}