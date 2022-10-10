<?php

namespace Hexhat\Coins\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Hexhat\Coins\Config;

class ConfigTest extends TestCase
{
    public function testGetConfigAndCheckItsType(): void
    {
        $getConfig = new Config();
        $config = $getConfig->getConfig();

        $this->assertIsString($config->token);
        $this->assertIsString($config->url);
        $this->assertIsString($config->locale);
        $this->assertIsString($config->currency);
        $this->assertIsObject($config->assets);
        $this->assertIsString($config->idlist);
    }
}
