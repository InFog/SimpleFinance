<?php

namespace tests\InFog\SimpleFinance\Entities;

class MovementTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $expected = new \InFog\SimpleFinance\Entities\Movement();
        $expected->setDate(new \DateTime('2013-01-01'));
        $expected->setAmount(new \InFog\SimpleFinance\Types\Money(100));
        $expected->setName(new \InFog\SimpleFinance\Types\SmallString('Test'));
        $expected->setDescription(new \InFog\SimpleFinance\Types\Text('Just a test'));

        $result = \InFog\SimpleFinance\Entities\Movement::createFromArray(array(
            'date' => '2013-01-01',
            'amount' => 100,
            'name' => 'Test',
            'description' => 'Just a test'
        ));

        $this->assertEquals($expected, $result);
    }
}
