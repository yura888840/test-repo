<?php

namespace FeedReader\Dataprovider\Assortment\DataSource;

interface IMapper
{
    public function getMapping();

    public function getMappingFunctionSet();
}