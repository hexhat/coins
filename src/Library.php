<?php

declare(strict_types=1);

namespace Hexhat\Coins\Library;

function checkExtensions(array $extensionsList, array $loadedExtensions): void
{
    foreach ($extensionsList as $extension) {
        if (! in_array($extension, $loadedExtensions)) {
            echo "Error: Can't find '{$extension}' extension";
            exit(1);
        }
    }
}

function findEnvVar(string $var): string
{
    if (getenv($var, true)) {
        return getenv($var, true);
    } else {
        return '';
    }
}

function formatCurrency(int | float $amount, string $locale, string $currency): string
{
    $fmt = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
    numfmt_set_attribute($fmt, \NumberFormatter::MAX_FRACTION_DIGITS, 0);
    return $fmt->formatCurrency($amount, $currency);
}
