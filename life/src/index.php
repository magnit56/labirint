<?php

namespace App;

require_once('./../vendor/autoload.php');

$field = new Field([
    [1, 0, 1, 0],
    [0, 1, 1, 0],
    [1, 1, 1, 1],
    [0, 1, 1, 0]
], 4, 4);

$game = new Game($field);
$game->play();
