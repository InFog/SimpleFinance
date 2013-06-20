<?php

class SmallStringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $string = new \InFog\SimpleFinance\Types\SmallString(array());
    }

    /**
     * @expectedException LengthException
     */
    public function testShouldThrowExceptionOnStringBiggerThan20()
    {
        $string = new \InFog\SimpleFinance\Types\SmallString(
            "The quick brown fox jumps over the lazy dog"
        );
    }
}
