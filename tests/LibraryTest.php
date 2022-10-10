<?php

namespace Hexhat\Coins\Tests;

use PHPUnit\Framework\TestCase;

use function Hexhat\Coins\Library\checkExtensions;
use function Hexhat\Coins\Library\findEnvVar;
use function Hexhat\Coins\Library\formatCurrency;

class LibraryTest extends TestCase
{
    public function testCheckExtensions(): void
    {
        // Void function will crash the program, and if not, assert true
        checkExtensions(['date'], get_loaded_extensions());
        $this->assertTrue(true);
    }

    public function testFindEnvVar(): void
    {
        $this->assertEquals(getenv('SHELL'), findEnvVar('SHELL'));
        $this->assertEquals('', findEnvVar('NOT_A_VAR'));
    }

    public function testFormatCurrency(): void
    {
        $result = formatCurrency(10.01, 'en_US', 'USD');
        $this->assertEquals('$10', $result);
    }
}
