<?php

namespace videoStore;

class Movie
{

    public static $children = 2;
    public static $regular = 0;
    public static $newRelease = 1;
    private $title;
    private $priceCode;

    public function __construct($title, $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode()
    {
        return $this->priceCode;
    }

    public function setPriceCode($priceCode)
    {
        $this->priceCode = $priceCode;
    }

    public function getTitle()
    {
        return $this->title;
    }

}
