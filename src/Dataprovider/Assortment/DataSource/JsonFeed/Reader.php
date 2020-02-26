<?php

namespace FeedReader\Dataprovider\Assortment\DataSource\JsonFeed;

use FeedReader\Dataprovider\Assortment\DataSource\IReader;

/**
 * Class Reader
 * @package FeedReader\Dataprovider\Assortment\DataSource\JsonFeed
 */
class Reader implements IReader
{
    /**
     * @return \Iterator
     * @throws \Exception
     */
    public function read() : \Iterator
    {
        $data = file_get_contents(__DIR__ . '/../../../../../data/wholesaler_b.json');

        try {
            $rows = \json_decode($data, true);
        } catch (\Exception $e) {
            throw $e;
        }

        foreach ($rows['data'] as $row) {
            yield $row;
        }
    }
}