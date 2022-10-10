<?php

namespace Hexhat\Coins\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Hexhat\Coins\Help;

class HelpTest extends TestCase
{
    public function testIsString(): void
    {
        $getHelp = new Help();
        $this->assertIsString($getHelp->getHelp());
    }

    public function testEightyCharsLimit(): void
    {
        $getHelp = new Help();
        foreach (explode("\n", $getHelp->getHelp()) as $line) {
            $this->assertLessThanOrEqual(80, mb_strlen($line));
        }
    }
}
