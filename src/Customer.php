<?php

namespace videoStore;

use videoStore\Rental;
use videoStore\Movie;

class Customer
{

    private $name;
    private $rental = [];

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        array_push($this->rental, $rental);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRentals()
    {
        return $this->rental;
    }

    public function createStatement()
    {
        $result = "Rental record for " . $this->getName() . " is : \n";
        $amount = 0;
        $frequentRenterPoints = 0;
        $totalAmount = 0;
        /* @var Rental $rental */
        foreach ($this->rental as $rental) {
            $amount = $rental->amountFor();
            $frequentRenterPoints++;
            if ($rental->getMovie()->getPriceCode() == Movie::$newRelease &&
                    $rental->getDaysRented() > 1) {
                $frequentRenterPoints++;
                $result .= "\t" . $rental->getMovie()->getTitle() . "\t";
                $result .= $amount . "\n";
                $totalAmount += $amount;
            }
        }
        //add footer lines
        $result .= "Amount owed is " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points \n";
        return $result;
    }
}
