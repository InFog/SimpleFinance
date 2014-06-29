<?php

namespace tests\InFog\SimpleFinance\Types;

use \InFog\SimpleFinance\Types\Money;
use \InFog\SimpleFinance\Types\Money\Config as MoneyConfig;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $money = new Money('a');
    }

    public function testShouldFormatMoneyWithDefaultValues()
    {
        $money = new Money(1000.99);

        $expected = '$ 1,000.99';
        $result = "{$money}";

        $this->assertEquals($expected, $result);
    }

    public function testShouldFormatMoneyWithNewConfig()
    {
        $money = new Money(1000.99);

        $config = new MoneyConfig();
        $config->setDecimalPoint(',');
        $config->setThousandsSeparator('.');
        $config->setMoneySimbol('R$');

        $money->setConfig($config);

        $expected = 'R$ 1.000,99';
        $result = "{$money}";

        $this->assertEquals($expected, $result);
    }
}
