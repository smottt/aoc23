<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');
$maxDuration = preg_replace('~^.+:\s+|\s+~', '', fgets($fh));
$minDistance = preg_replace('~^.+:\s+|\s+~', '', fgets($fh));
$winning = 0;

for ($speed = 1; $speed <= $maxDuration; $speed++) {
    $distance = $speed * ($maxDuration - $speed);
    $winning += $distance > $minDistance;
}

var_dump($winning);
var_dump($winning === 27340847);
