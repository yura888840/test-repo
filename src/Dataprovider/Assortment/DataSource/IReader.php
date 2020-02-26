<?php

namespace FeedReader\Dataprovider\Assortment\DataSource;

interface IReader
{
    public function read() : \Iterator;
}