<?php

namespace Hexhat\Coins\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Hexhat\Coins\Connect;
use Hexhat\Coins\Config;
use Hexhat\Coins\Report;

class ReportTest extends TestCase
{
    public function testGetReportAndCheckIsDigit(): void
    {
        $getConfig = new Config();
        $config = $getConfig->getConfig();
        $connect = new Connect();
        $response = $connect->dialUp($config);
        $report = new Report();
        $result = $report->getReport($config, $response);

        $this->assertIsString($result);
        $this->assertMatchesRegularExpression('/\d/', $result);
    }
}
