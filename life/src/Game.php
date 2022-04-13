<?php

namespace App;

class Game
{
    protected $field;
    
    public function __construct(Field $field)
    {
        $this->field = $field;
    }
    
    public function play()
    {
        do {
            $this->iterate();
            echo ($this->field);
        } while (!$this->isGameOver());
    }
    
    protected function isGameOver(): bool
    {
        $cells = collect($this->field->cells);
        return $cells->flatten()->reduce(function ($acc, $cell) {
            return ($cell->state === 'alive') ? false : $acc;
        }, true);
    }

    protected function iterate()
    {
        $newStates = [];
        for ($i = 0; $i < $this->field->m; $i++) {
            for ($j = 0; $j < $this->field->n; $j++) {
                $cell = $this->field->cells[$i][$j];
                $countOfActiveNeighbors = $this->countOfActiveNeighbors($i, $j);
                if ($cell->mustBeActivated($countOfActiveNeighbors)) {
                    $newStates[$i][$j] = 'alive';
                    // $cell->state = 'alive';
                } elseif ($cell->mustBeDied($countOfActiveNeighbors)) {
                    $newStates[$i][$j] = 'dead';
                } else {
                    $newStates[$i][$j] = $cell->state;
                }
            }
        }

        for ($i = 0; $i < $this->field->m; $i++) {
            for ($j = 0; $j < $this->field->n; $j++) {
                $cell = $this->field->cells[$i][$j];
                $cell->state = $newStates[$i][$j];
            }
        }
    }
    
    protected function countOfActiveNeighbors($i, $j)
    {
        $count = 0;
        for ($m = $i - 1; $m <= $i + 1; $m++) {
            for ($n = $j - 1; $n <= $j + 1; $n++) {
                if ($m === $i && $n === $j) {
                    continue;
                }
                if (isset($this->field->cells[$m][$n])) {
                    $count = ($this->field->cells[$m][$n]->isAlive()) ? $count + 1 : $count;
                }
            }
        }
        return $count;
    }
}
