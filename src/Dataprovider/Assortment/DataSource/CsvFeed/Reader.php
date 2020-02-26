<?php

namespace FeedReader\Dataprovider\Assortment\DataSource\CsvFeed;

use FeedReader\Dataprovider\Assortment\DataSource\IReader;

/**
 * Class Reader
 * @package FeedReader\Dataprovider\Assortment\DataSource\CsvFeed
 */
class Reader implements IReader
{
    /**
     * @return \Iterator
     */
    public function read() : \Iterator
    {
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $c = 0;
        $headers = $products = [];
        $handle = fopen(__DIR__ . '/../../../../../data/wholesaler_a.csv', 'r');

        while ( ($data = fgetcsv($handle, 0, ';') ) !== false) {
            if (0 == $c++) {
                $headers = $data;
                continue;
            }
            yield  array_combine($headers, $data);
        }
    }
}