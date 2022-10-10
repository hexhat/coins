<?php

declare(strict_types=1);

namespace Hexhat\Coins;

use function Hexhat\Coins\Library\formatCurrency;

class Cron
{
    public function getTotal(\stdClass $config, \stdClass $response): string
    {
        $currency = $config->currency;
        $totalSum = 0;
        $assetsArray = json_decode(json_encode($config->assets), true);
        foreach ($response->data as $item) {
            $id = $item->id;
            $symbol = array_key_first($assetsArray[$item->id]);
            $price = $item->quote->$currency->price;
            $amount = $assetsArray[$id][$symbol];
            $totalSum += $price * $amount;
        }

        return formatCurrency($totalSum, $config->locale, $config->currency);
    }
}
