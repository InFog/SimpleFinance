<?php

class MovementRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAMovement()
    {
        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate(new \DateTime());
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money(10));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString('Testing Repository'));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of a movement'));

        $movement_id = \InFog\SimpleFinance\Repositories\Movement::save($movement);

        $this->assertTrue(is_integer($movement_id));
    }
}
