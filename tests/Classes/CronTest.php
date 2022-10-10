<?php

namespace Hexhat\Coins\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Hexhat\Coins\Connect;
use Hexhat\Coins\Config;
use Hexhat\Coins\Cron;

class CronTest extends TestCase
{
    public function testGetTotalAndCheckIsDigit(): void
    {
        $getConfig = new Config();
        $config = $getConfig->getConfig();
        $connect = new Connect();
        $response = $connect->dialUp($config);
        $cron = new Cron();
        $total = $cron->getTotal($config, $response);

        $this->assertIsString($total);
        $this->assertMatchesRegularExpression('/\d/', $total);
    }
}
