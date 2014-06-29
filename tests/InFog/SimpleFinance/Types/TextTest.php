<?php

namespace tests\InFog\SimpleFinance\Types;

use \InFog\SimpleFinance\Types\Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidValue()
    {
        $string = new Text(array());
    }

    /**
     * @expectedException LengthException
     */
    public function testShouldThrowExceptionOnTextBiggerThan255()
    {
        $string = new Text(
            "Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
            ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
            occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum."
        );
    }

    public function testShouldCreateTextAndConcatenate()
    {
        $text1 = new Text('My testing text');
        $text2 = new Text(' is awesome!');

        $expected = 'My testing text is awesome!';
        $result = $text1 . $text2;

        $this->assertEquals($expected, $result);
    }
}
