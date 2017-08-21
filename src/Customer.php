<?php

namespace videoStore;

use videoStore\Rental;

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
    
    public function getRentals(){
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
            $movie = $rental->getMovie();
            switch ($movie->getPriceCode()) {
                case Movie::$regular: $amount = $amount + 2;
                    if ($rental->getDaysRented() > 2) {
                        $amount = ($rental->getDaysRented() - 2) * 1.5;
                    }
                    break;
                case Movie::$children: $amount = $amount + 1.5;
                    if ($rental->getDaysRented() > 3) {
                        $amount += ($rental->getDaysRented() - 3) * 1.5;
                    }
                    break;
                case Movie::$newRelease:
                    echo "hre";
                    $amount += $rental->getDaysRented() * 3;
                    break;
            }
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
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";
        return $result;
    }

}
