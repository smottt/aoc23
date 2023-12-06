<?php

declare(strict_types = 1);

$start = hrtime(true);

error_reporting(-1);
ini_set('display_errors', 'on');

$fh = fopen(__DIR__ . '/input.txt', 'r');

$seeds = array_filter(explode(' ', trim(fgets($fh))), fn ($in) => is_numeric($in));
$seeds = array_combine(array_values($seeds), array_values($seeds));

while (($line = fgets($fh)) !== false) {
    if (empty(trim($line))) {
        continue;
    }

    // can't be bothered to track otherwise
    $wasProcessed = [];

    while (trim($mapping = fgets($fh) ?: '')) {
        [$dest, $source, $range] = array_map('intval', explode(' ', $mapping));
        $sourceMax = $source + $range -1;

        foreach ($seeds as $seed => &$value) {
            if (isset($wasProcessed[$seed])) {
                continue;
            }

            // Out of range
            if ($value < $source || $value > $sourceMax) {
                continue;
            }

            $value = $dest + ($value - $source);
            $wasProcessed[$seed] = true;
        }
    }
}

// Expect: 227653707
var_dump(min($seeds));
var_dump(hrtime(true) - $start);
