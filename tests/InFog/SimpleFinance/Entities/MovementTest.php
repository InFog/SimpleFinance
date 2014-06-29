<?php

namespace tests\InFog\SimpleFinance\Entities;

use \InFog\SimpleFinance\Entities\Movement;
use \InFog\SimpleFinance\Types\Money;
use \InFog\SimpleFinance\Types\SmallString;
use \InFog\SimpleFinance\Types\Text;

class MovementTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $expected = new Movement();
        $expected->setDate(new \DateTime('2013-01-01'));
        $expected->setAmount(new Money(100));
        $expected->setName(new SmallString('Test'));
        $expected->setDescription(new Text('Just a test'));

        $result = Movement::createFromArray(array(
            'date' => '2013-01-01',
            'amount' => 100,
            'name' => 'Test',
            'description' => 'Just a test'
        ));

        $this->assertEquals($expected, $result);
    }
}
