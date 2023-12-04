<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');

$possibleGameIds = [];

while (($line = fgets($fh)) !== false) {
    $cubes = [
        'blue' => 0,
        'red'  => 0,
        'green' => 0,
    ];

    preg_match('~^Game (?<gameId>\d+):~', $line, $matches);

    $gameId = (int) $matches['gameId'];

    $justCubesLine = trim(substr($line, strlen($matches[0])));

    $subsets = explode('; ', $justCubesLine);

    foreach ($subsets as $permutation) {
        $sCubes = explode(', ', $permutation);

        foreach ($sCubes as $part) {
            [$number, $color] = explode(' ', $part);

            $cubes[$color] = max($cubes[$color], $number);
        }
    }

    // Skip impossible games
    if ($cubes['red'] > 12 || $cubes['green'] > 13 || $cubes['blue'] > 14) {
        continue;
    }

    $possibleGameIds[] = $gameId;
}

var_dump(array_sum($possibleGameIds));
