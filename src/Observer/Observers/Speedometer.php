<?php

namespace DesignPatterns\Observer\Observers;

use DesignPatterns\Observer\Subjects\Car;
use SplObserver;
use SplSubject;

class Speedometer implements SplObserver
{
    protected int $speed = 0;

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function update(SplSubject $subject): void
    {
        if (!($subject instanceof Car)) {
            return;
        }

        $this->speed = $subject->getSpeed();
    }

    public function __toString(): string
    {
        return "The current speed is $this->speed km/h\r";
    }
}
