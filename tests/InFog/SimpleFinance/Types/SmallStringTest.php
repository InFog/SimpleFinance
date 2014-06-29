<?php

namespace tests\InFog\SimpleFinance\Types;

use \InFog\SimpleFinance\Types\SmallString;

class SmallStringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $string = new SmallString(array());
    }

    /**
     * @expectedException LengthException
     */
    public function testShouldThrowExceptionOnStringBiggerThan20()
    {
        $string = new SmallString(
            "The quick brown fox jumps over the lazy dog"
        );
    }

    public function testShouldCreateSmallStringAndConcatenate()
    {
        $firstName = new SmallString('Evaldo');
        $lastName = new SmallString('Bento');

        $expected = 'Evaldo Bento';
        $result = "{$firstName} {$lastName}";

        $this->assertEquals($expected, $result);
    }
}
