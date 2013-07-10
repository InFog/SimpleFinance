<?php

class MovementRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $pdo = new PDO(PDO_DSN);
        $pdo->exec(file_get_contents(SETUP_DIR . 'create_database.sql'));

        \InFog\SimpleFinance\Repositories\Movement::setPdo($pdo);
    }

    public function testCreateAMovement()
    {
        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate(new \DateTime());
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money(10));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString('Testing Repository'));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of a movement'));

        $movement_id = \InFog\SimpleFinance\Repositories\Movement::save($movement);

        $this->assertTrue(is_numeric($movement_id));
    }

    public function testCreateDTO()
    {
        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate(new \DateTime());
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money(10));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString('Testing DTO'));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of DTO'));

        $expected = new stdClass();
        $expected->id = null;
        $expected->date = $movement->getDate()->format('Y-m-d H:i:s');
        $expected->amount = 10;
        $expected->name = 'Testing DTO';
        $expected->description = 'Description of DTO';

        $result = \InFog\SimpleFinance\Repositories\Movement::createDTO($movement);

        $this->assertEquals($expected, $result);
    }
}
