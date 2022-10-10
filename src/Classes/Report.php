<?php

declare(strict_types=1);

namespace Hexhat\Coins;

use function Hexhat\Coins\Library\formatCurrency;

class Report
{
    public function getReport(\stdClass $config, \stdClass $response): string
    {
        $currency = $config->currency;
        $assetsArray = json_decode(json_encode($config->assets), true);
        $report = '';
        foreach ($response->data as $item) {
            $id = $item->id;
            $symbol = array_key_first($assetsArray[$item->id]);
            $price = $item->quote->$currency->price;
            $amount = $assetsArray[$id][$symbol];
            $worth = $price * $amount;
            $result = formatCurrency($worth, $config->locale, $config->currency);
            $report .= "{$symbol}\t:\t{$result}\n";
        }
        return $report;
    }
}
