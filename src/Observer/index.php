<?php

use DesignPatterns\Observer\Observers\Speedometer;
use DesignPatterns\Observer\Subjects\Car;

require_once __DIR__ . '/../../vendor/autoload.php';

$speedometer = new Speedometer();
$car = new Car();
$car->attach($speedometer);

// Every time the car's speed gets updated, the speedometer gets notified and updates it's own speed accordingly

for ($i = 1; $i <= 100; $i++) {
    $car->speedUp(1);
    echo $speedometer;
    usleep($i * 2500);
}
