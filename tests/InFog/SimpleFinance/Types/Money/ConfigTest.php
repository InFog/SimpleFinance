<?php

namespace tests\InFog\SimpleFinance\Types\Money;

use \InFog\SimpleFinance\Types\Money\Config as MoneyConfig;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldSetAndGetDecimalPoint()
    {
        $expected = '#';

        $config = new MoneyConfig();
        $config->setDecimalPoint($expected);

        $result = $config->getDecimalPoint();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidDecimalPoint()
    {
        $config = new MoneyConfig();
        $config->setDecimalPoint(array(1));
    }

    public function testShouldSetAndGetThousandsSeparator()
    {
        $expected = '#';

        $config = new MoneyConfig();
        $config->setThousandsSeparator($expected);

        $result = $config->getThousandsSeparator();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidThousandsSeparator()
    {
        $config = new MoneyConfig();
        $config->setThousandsSeparator(array(1));
    }

    public function testShouldSetAndGetMoneySimbol()
    {
        $expected = '#';

        $config = new MoneyConfig();
        $config->setMoneySimbol($expected);

        $result = $config->getMoneySymbol();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidMoneySimbol()
    {
        $config = new MoneyConfig();
        $config->setMoneySimbol(array(1));
    }
}
