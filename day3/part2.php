<?php

declare(strict_types = 1);

$input = file_get_contents(__DIR__ . '/input.txt');
$rows = explode("\n", $input);

$map = array_map(fn (string $row): array => str_split($row), $rows);

class Point {
    public function __construct(
        public int $x,
        public int $y,
    ) {}
}

function isConnected(array $map, int $x, int $y): ?Point {
    for ($i = ($x - 1); $i <= ($x + 1); $i++) {
        for ($j = $y - 1; $j <= $y + 1; $j++) {
            $value = $map[$i][$j] ?? null;

            if ($value === '*') {
                return new Point($i, $j);
            }
        }
    }

    return null;
}

$stars         = [];
$currentNumber = "";
$isConnected = null;

foreach ($map as $x => $row) {
    foreach ($row as $y => $value) {
        if (!is_numeric($value)) {
            if ($currentNumber && $isConnected) {
                $stars[$isConnected->x][$isConnected->y][] = (int) $currentNumber;
                $isConnected                               = null;
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

$result = 0;

foreach ($stars as $x => $row) {
    foreach ($row as $y => $numbers) {
        if (count($numbers) < 2) {
            continue;
        }

        $result += array_reduce(array_values($numbers), fn (?int $carry, int $value): int => ($carry ?? 1) * $value);
    }
}

var_dump($result);
