<?php

class MovementTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $expected = new \InFog\SimpleFinance\Entities\Movement();
        $expected->setDate(new \DateTime());
        $expected->setAmount(new \InFog\SimpleFinance\Types\Money(100));
        $expected->setName('Test');
        $expected->setDescription('Just a test');

        $result = InFog\SimpleFinance\Entities\Movement::createFromArray(array(
            'date' => new \DateTime(),
            'amount' => new \InFog\SimpleFinance\Types\Money(100),
            'name' => 'Test',
            'description' => 'Just a test'
        ));

        $this->assertEquals($expected, $result);
    }
}
