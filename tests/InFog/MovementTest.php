<?php

class MovementTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $expected = new InFog\Entities\Movement();
        $expected->setDate(new DateTime());
        $expected->setAmount(100);
        $expected->setName('Test');
        $expected->setDescription('Just a test');

        $result = InFog\Entities\Movement::createFromArray(array(
            'date' => new DateTime(),
            'amount' => 100,
            'name' => 'Test',
            'description' => 'Just a test'
        ));

        $this->assertEquals($expected, $result);
    }
}
