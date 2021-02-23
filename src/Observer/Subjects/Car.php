<?php

namespace DesignPatterns\Observer\Subjects;

class Car extends AbstractSubject
{
    protected int $speed = 0;

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function speedUp(int $amount): void
    {
        $this->speed += $amount;
        $this->notify();
    }
}
