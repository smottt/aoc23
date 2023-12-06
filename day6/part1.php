<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');
$times = preg_split('~\s+~', trim(fgets($fh)));
$distances = preg_split('~\s+~', trim(fgets($fh)));

$winning = array_fill(1, count($times) - 2, 0);

for ($i = 1; $i < count($times); $i++) {
    $maxDuration = (int) $times[$i];
    $minDistance = (int) $distances[$i];

    for ($speed = 1; $speed <= $maxDuration; $speed++) {
        $distance = $speed * ($maxDuration - $speed);
        $winning[$i] += (int) $distance > $minDistance;
    }
}

var_dump(array_product($winning));
