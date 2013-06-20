<?php

class MoneyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $money = new \InFog\SimpleFinance\Types\Money('a');
    }
}
