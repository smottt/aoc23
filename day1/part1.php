<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');

$values = [];

while (($line = fgets($fh)) !== false) {
    if (empty(trim($line))) {
        continue;
    }

    $digits = [];

    for ($i = 0; $i < strlen($line); $i++) {
        if (is_numeric($line[$i])) {
            $digits[] = $line[$i];
        }
    }

    $first = reset($digits);
    $last = end($digits);

    $values[] = sprintf('%d%d', $first, $last);
}

@fclose($fh);

echo array_sum($values), PHP_EOL;
