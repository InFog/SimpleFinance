<?php

namespace tests\InFog\SimpleFinance\Repositories;

use \InFog\SimpleFinance\Repositories\Movement as Repository;

class MovementTest extends \PHPUnit_Framework_TestCase
{
    private $pdo;

    public function setUp()
    {
        $this->pdo = new \PDO(PDO_DSN);
        $this->pdo->exec(file_get_contents(SETUP_DIR . 'create_sqlite_database.sql'));

        $this->repository = new Repository();

        $this->repository->setPdo($this->pdo);
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

        $expected = new \stdClass();
        $expected->id = null;
        $expected->date = $movement->getDate()->format('Y-m-d H:i:s');
        $expected->amount = 10;
        $expected->name = 'Testing DTO';
        $expected->description = 'Description of DTO';

        $result = $this->repository->createDTO($movement);

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

        $movement = $this->repository->fetch(array('id' => $movement_id));

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Entities\\Movement', $movement);
    }

    public function testRetrieveMovementCollection()
    {
        $this->createAMovement();

        $movementCollection = $this->repository->fetchAll();

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
    }

    public function testRetrieveMovementCollectionFromGivenMonth()
    {
        $this->createAMovement(null, null, new \DateTime('2013-03-09'));
        $this->createAMovement(null, null, new \DateTime('2013-03-18'));

        $movementCollection = $this->repository->fetchMonth(
            new \InFog\SimpleFinance\Types\Month(2013, 3)
        );

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
        $this->assertEquals(2, count($movementCollection));
    }

    public function testRetrieveMovementCollectionFromGivenMonthFirstAndLastDay()
    {
        $this->createAMovement(null, null, new \DateTime('2013-01-01'));
        $this->createAMovement(null, null, new \DateTime('2013-01-31'));

        $movementCollection = $this->repository->fetchMonth(
            new \InFog\SimpleFinance\Types\Month(2013, 1)
        );

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
        $this->assertEquals(2, count($movementCollection));
    }

    public function testRetrieveMovementCollectionFromGivenPeriod()
    {
        $this->createAMovement(null, null, new \DateTime('2012-10-01'));
        $this->createAMovement(null, null, new \DateTime('2012-10-25'));
        $this->createAMovement(null, null, new \DateTime('2012-11-05'));

        $movementCollection = $this->repository->fetchPeriod(
            new \DateTime('2012-10-01'),
            new \DateTime('2012-11-30')
        );

        $this->assertInstanceOf('\\InFog\\SimpleFinance\\Collections\\Movement', $movementCollection);
        $this->assertEquals(3, count($movementCollection));
    }

    private function createAMovement($name = null, $amount = null, \DateTime $date = null)
    {
        $name = ($name) ? $name : 'Testing Repository';
        $amount = ($amount) ? $amount : 10;
        $date = ($date) ? $date : new \DateTime();

        $movement = new \InFog\SimpleFinance\Entities\Movement();
        $movement->setDate($date);
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money($amount));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString($name));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text('Description of a movement'));

        return $this->repository->save($movement);
    }
}
