<?php

declare(strict_types = 1);

$input = file_get_contents(__DIR__ . '/input.txt');
$rows = explode("\n", $input);

$map = array_map(fn (string $row): array => str_split($row), $rows);

function isConnected(array $map, int $x, int $y): bool {
    for ($i = ($x - 1); $i <= ($x + 1); $i++) {
        for ($j = $y - 1; $j <= $y + 1; $j++) {
            $value = $map[$i][$j] ?? null;

            if ($value === null || preg_match('~^[a-z\d.]$~i', $value)) {
                continue;
            }

            return true;
        }
    }

    return false;
}

$result = [];
$notConnected = [];

$currentNumber = "";
$isConnected = false;

foreach ($map as $x => $row) {
    foreach ($row as $y => $value) {
        if (!is_numeric($value)) {
            if ($currentNumber && !$isConnected) {
                $notConnected[] = $currentNumber;
            }

            if ($currentNumber && $isConnected) {
                $isConnected = false;
                $result[] = (int) $currentNumber;
            }

            $currentNumber = "";

            continue;
        }

        if (!$isConnected) {
            $isConnected = isConnected($map, $x, $y);
        }

        $currentNumber .= $value;
    }
}

var_dump(array_sum($result));
