<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');

$stringDigits = [
    1 => 'one',
    2 => 'two',
    3 => 'three',
    4 => 'four',
    5 => 'five',
    6 => 'six',
    7 => 'seven',
    8 => 'eight',
    9 => 'nine',
];

$values = [];

while (($line = fgets($fh)) !== false) {
    if (empty(trim($line))) {
        continue;
    }

    $digits = [];

    for ($i = 0; $i < strlen($line); $i++) {
        if (is_numeric($line[$i])) {
            $digits[] = $line[$i];
            continue;
        }

        foreach ($stringDigits as $intDigit => $stringDigit) {
            if (substr($line, $i, strlen($stringDigit)) === $stringDigit) {
                $digits[] = $intDigit;
            }
        }
    }

    $first = reset($digits);
    $last = end($digits);

    $values[] = sprintf('%d%d', $first, $last);
}

@fclose($fh);

var_dump($values);
echo array_sum($values), PHP_EOL;
