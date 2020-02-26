<?php


namespace FeedReader\Dataprovider\Assortment;


interface DataProvider
{
    /**
     * @return Product[]
     */
    public function getProducts() : array;
}
