<?php

class MovementEntityTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $expected = new \InFog\SimpleFinance\Entities\Movement();
        $expected->setDate(new \DateTime());
        $expected->setAmount(new \InFog\SimpleFinance\Types\Money(100));
        $expected->setName(new \InFog\SimpleFinance\Types\SmallString('Test'));
        $expected->setDescription(new \InFog\SimpleFinance\Types\Text('Just a test'));

        $result = InFog\SimpleFinance\Entities\Movement::createFromArray(array(
            'date' => new \DateTime(),
            'amount' => new \InFog\SimpleFinance\Types\Money(100),
            'name' => new \InFog\SimpleFinance\Types\SmallString('Test'),
            'description' => new \InFog\SimpleFinance\Types\Text('Just a test')
        ));

        $this->assertEquals($expected, $result);
    }
}
