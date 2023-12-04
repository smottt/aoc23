<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');

$result = 0;

while (($line = fgets($fh)) !== false) {
    [, $left]    = explode(': ', $line);
    [$left, $right] = explode(' | ', $left);

    $winningCardNumbers = [];
    $myWinningNumbers   = 0;

    for ($i = 0; $i < strlen($left); $i += 3) {
        $winningCardNumbers[sprintf('%d%d', $left[$i], $left[$i+1])] = 1;
    }

    for ($i = 0; $i < strlen($right); $i += 3) {
        $number = sprintf('%d%d', $right[$i], $right[$i+1]);

        if (isset($winningCardNumbers[$number])) {
            $myWinningNumbers++;
        }
    }

    if ($myWinningNumbers > 0) {
        $result += 2 ** ($myWinningNumbers - 1);
    }
}

var_dump($result);
