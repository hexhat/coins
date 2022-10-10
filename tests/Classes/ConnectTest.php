<?php

namespace Hexhat\Coins\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Hexhat\Coins\Connect;
use Hexhat\Coins\Config;

class ConnectTest extends TestCase
{
    public function testDialUp(): void
    {
        $getConfig = new Config();
        $config = $getConfig->getConfig();
        $connect = new Connect();
        $response = $connect->dialUp($config);

        foreach ($response->data as $item) {
            $this->assertIsInt($item->id);
            $this->assertIsString($item->symbol);
            $this->assertIsObject($item->quote);
        }
    }
}
