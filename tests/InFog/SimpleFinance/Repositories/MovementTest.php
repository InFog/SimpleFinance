<?php

class MovementRepositoryTest extends PHPUnit_Framework_TestCase
{
    private $pdo;

    public function setUp()
    {
        $this->pdo = new PDO(PDO_DSN);
        $this->pdo->exec(file_get_contents(SETUP_DIR . 'create_sqlite_database.sql'));

        \InFog\SimpleFinance\Repositories\Movement::setPdo($this->pdo);
    }

    public function tearDown()
    {
        $this->pdo->exec('DELETE FROM movement');
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

    public function testCreateAMovement()
    {
        $movement_id = $this->createAMovement();

        $this->assertTrue(is_numeric($movement_id));
    }

    public function testCreateAndRetrieveAMovement()
    {
        $movement_id = $this->createAMovement();

        $movement = \InFog\SimpleFinance\Repositories\Movement::fetch(array('id' => $movement_id));

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Entities\\Movement', $movement);
    }

    public function testRetrieveMovementCollection()
    {
        $this->createAMovement();

        $movementCollection = \InFog\SimpleFinance\Repositories\Movement::fetchAll();

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
    }

    private function createAMovement()
    {
        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate(new \DateTime());
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money(10));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString('Testing Repository'));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of a movement'));

        return \InFog\SimpleFinance\Repositories\Movement::save($movement);
    }
}
