<?php

namespace App;

use JetBrains\PhpStorm\Pure;

class Cell
{
    public $state;
    
    public function __construct($stateName)
    {
        $this->state = $stateName;
    }

    public function isDead(): bool
    {
        return ($this->state === 'dead');
    }

    public function isAlive(): bool
    {
        return ($this->state === 'alive');
    }

    public function mustBeActivated($countOfActiveNeighbors)
    {
        return ($this->isDead() && $countOfActiveNeighbors === 3);
    }

    public function mustBeDied($countOfActiveNeighbors)
    {
        return
            ($this->isAlive() && $countOfActiveNeighbors >= 4) ||
            ($this->isAlive() && $countOfActiveNeighbors <= 1)
            ;
    }
    
    public function __toString(): string
    {
        return ($this->isAlive()) ? '1' : '0';
    }
}
