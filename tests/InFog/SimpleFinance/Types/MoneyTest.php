<?php

namespace tests\InFog\SimpleFinance\Types;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $money = new \InFog\SimpleFinance\Types\Money('a');
    }

    public function testShouldFormatMoneyWithDefaultValues()
    {
        $money = new \InFog\SimpleFinance\Types\Money(1000.99);

        $expected = '$ 1,000.99';
        $result = "{$money}";

        $this->assertEquals($expected, $result);
    }

    public function testShouldFormatMoneyWithNewConfig()
    {
        $money = new \InFog\SimpleFinance\Types\Money(1000.99);

        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setDecimalPoint(',');
        $config->setThousandsSeparator('.');
        $config->setMoneySimbol('R$');

        $money->setConfig($config);

        $expected = 'R$ 1.000,99';
        $result = "{$money}";

        $this->assertEquals($expected, $result);
    }
}
