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

    public function testRetrieveMovementCollectionWithConditions()
    {
        $this->createAMovement();
        $this->createAMovement();
        $this->createAMovement('Other name', 1000);
        $this->createAMovement('Another name', 1000);

        $movementCollection = \InFog\SimpleFinance\Repositories\Movement::fetchAll(array('amount >=' => 1000));

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
        $this->assertEquals(2, count($movementCollection));
    }

    private function createAMovement($name = null, $amount = null)
    {
        $name = ($name) ? $name : 'Testing Repository';
        $amount = ($amount) ? $amount : 10;

        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate(new \DateTime());
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money($amount));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString($name));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of a movement'));

        return \InFog\SimpleFinance\Repositories\Movement::save($movement);
    }
}
