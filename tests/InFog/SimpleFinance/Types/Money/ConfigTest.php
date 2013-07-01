<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testShouldSetAndGetDecimalPoint()
    {
        $expected = '#';

        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setDecimalPoint($expected);

        $result = $config->getDecimalPoint();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidDecimalPoint()
    {
        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setDecimalPoint(array(1));
    }

    public function testShouldSetAndGetThousandsSeparator()
    {
        $expected = '#';

        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setThousandsSeparator($expected);

        $result = $config->getThousandsSeparator();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidThousandsSeparator()
    {
        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setThousandsSeparator(array(1));
    }

    public function testShouldSetAndGetMoneySimbol()
    {
        $expected = '#';

        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setMoneySimbol($expected);

        $result = $config->getMoneySymbol();

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldSetInvalidMoneySimbol()
    {
        $config = new \InFog\SimpleFinance\Types\Money\Config();
        $config->setMoneySimbol(array(1));
    }
}
