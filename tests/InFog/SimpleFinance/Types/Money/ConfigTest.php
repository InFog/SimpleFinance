<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testShouldSetInvalidMoneySimbol()
    {
        $expected = '#';

        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setMoneySimbol($expected);

        $result = $config->getMoneySymbol();

        $this->assertEquals($expected, $result);
    }
}
