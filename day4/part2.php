<?php

declare(strict_types = 1);

$fh = fopen(__DIR__ . '/input.txt', 'r');

$totalCards = 0;

$copies = [];

for ($c = 0; ($line = fgets($fh)) !== false; $c++) {
    [, $left]       = explode(': ', $line);
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

    $totalCards += 1 + ($copies[$c] ?? 0);

    for ($i = $c + 1; $i < ($c + 1 + $myWinningNumbers); $i++) {
        $copies[$i] ??= 0;
        $copies[$i] += 1 + ($copies[$c] ?? 0);
    }
}

var_dump($totalCards);
