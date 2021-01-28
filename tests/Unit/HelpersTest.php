<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test_count_formatted()
    {
        $this->assertEquals(count_formatted(3000), '3K');
        $this->assertEquals(count_formatted(35500), '35.5K');
        $this->assertEquals(count_formatted(905000), '905K');
        $this->assertEquals(count_formatted(5500000), '5.5M');
        $this->assertEquals(count_formatted(88800000), '88.8M');
        $this->assertEquals(count_formatted(745000000), '745M');
        $this->assertEquals(count_formatted(2000000000), '2B');
        $this->assertEquals(count_formatted(22200000000), '22.2B');
        $this->assertEquals(count_formatted(1000000000000), '1T');
    }
}
