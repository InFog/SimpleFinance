<?php

namespace tests\InFog\SimpleFinance\Types;

use \InFog\SimpleFinance\Types\Month;

class MonthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateMonthShouldRaiseExceptionOnWrongYear()
    {
        $month = new Month('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateMonthShouldRaiseExceptionOnWrongMonth()
    {
        $month = new Month(2011, 'b');
    }

    public function testShouldReturnValue()
    {
        $month = new Month(2002, 3);

        $expected = '2002-03';
        $result = $month->getValue();

        $this->assertEquals($expected, $result);
    }

    public function testShouldReturnYearAndMonth()
    {
        $month = new Month(2011, 10);

        $expected = 2011;
        $result = $month->getYear();

        $this->assertEquals($expected, $result);

        $expected = 10;
        $result = $month->getMonth();

        $this->assertEquals($expected, $result);
    }

    public function testShouldGetFirstDayFromGivenMonth()
    {
        $month = new Month(2013, 3);

        $expected = new \DateTime('2013-03-01');
        $result = $month->getFirstDay();

        $this->assertEquals($expected, $result);
    }

    public function testShouldGetLastDayFromGivenMonth()
    {
        $month = new Month(2013, 3);

        $expected = new \DateTime('2013-03-31');
        $result = $month->getLastDay();

        $this->assertEquals($expected, $result);
    }
}
