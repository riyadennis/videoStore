<?php

namespace videoStore;

use videoStore\Movie;

class Rental
{

    private $movie;
    private $daysRented;

    public function __construct(Movie $movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented()
    {
        return $this->daysRented;
    }
    
    public function getMovie()
    {
        return $this->movie;
    }
    /**
     * 
     * @return int
     */
    public function amountFor()
    {
        $amount = 0.00;
        $movie = $this->getMovie();
        switch ($movie->getPriceCode()) {
            case Movie::$regular: $amount = $amount + 2;
                if ($this->getDaysRented() > 2) {
                    $amount = ($this->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::$children: $amount = $amount + 1.5;
                if ($this->getDaysRented() > 3) {
                    $amount += ($this->getDaysRented() - 3) * 1.5;
                }
                break;
            case Movie::$newRelease:
                echo "hre";
                $amount += $this->getDaysRented() * 3;
                break;
        }
        return $amount;
    }

}
