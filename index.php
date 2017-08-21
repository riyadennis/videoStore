<?php
require_once 'src/Movie.php';
require_once 'src/Customer.php';
require_once 'src/Rental.php';

use videoStore\Customer;
use videoStore\Movie;
use videoStore\Rental;

$movie = new Movie("Kidnap", Movie::$newRelease);
$movie1 = new Movie("Dark Matter", Movie::$newRelease);

$customer = new Customer("Riya");

$rental = new Rental($movie, 2);
$rental1 = new Rental($movie1, 2);

$customer->addRental($rental);
$customer->addRental($rental1);

$statement = $customer->createStatement();
print($statement);


