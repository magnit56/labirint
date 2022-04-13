<?php

namespace App;

class Field
{
    public $cells;
    public $m;
    public $n;
    
    public function __construct(array $cells, int $m, int $n)
    {
        $this->m = $m;
        $this->n = $n;
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $stateName = ($cells[$i][$j] == 1) ? 'alive' : 'dead';
                $cell = new Cell($stateName);
                $this->cells[$i][$j] = $cell;
            }
        }
    }
    
    public function __toString()
    {
        $str = '';
        for ($i = 0; $i < $this->m; $i++) {
            for ($j = 0; $j < $this->n; $j++) {
                $str = $str . $this->cells[$i][$j];
            }
            $str = $str . PHP_EOL;
        }
        $str = $str . PHP_EOL;
        return $str;
    }
}
