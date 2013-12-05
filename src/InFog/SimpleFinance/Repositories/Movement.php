<?php

namespace InFog\SimpleFinance\Repositories;

use \Respect\Relational\Mapper;

class Movement
{
    /**
     * @var $pdo \PDO
     */
    private $pdo;

    /**
     * @var $mapper \Respect\Relational\Mapper
     */
    private $mapper;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function getPdo()
    {
        if (! $this->pdo) {
            $this->pdo = new \PDO(PDO_DSN);
        }

        return $this->pdo;
    }

    private function getMapper()
    {
        if (! $this->mapper) {
            $this->mapper = new Mapper($this->getPdo());
            $this->mapper->entityNamespace = '\\InFog\\SimpleFinance\\Entities';
        }

        return $this->mapper;
    }

    public function save(\InFog\SimpleFinance\Entities\Movement $movement)
    {
        $movementDTO = $this->createDTO($movement);

        $mapper = $this->getMapper();
        $mapper->movement->persist($movementDTO);
        $mapper->flush();

        return $movementDTO->id;
    }

    public function fetch(array $conditions)
    {
        $mapper = $this->getMapper();
        $movementDTO = $mapper->movement($conditions)->fetch();

        return \InFog\SimpleFinance\Entities\Movement::createFromArray(
            (array) $movementDTO
        );
    }

    public function fetchAll(array $conditions = null)
    {
        if (is_array($conditions)) {
            return $this->fetchConditions($conditions);
        }

        $mapper = $this->getMapper();
        return $this->createCollection($mapper->movement->fetchAll());
    }

    public function fetchMonth(\InFog\SimpleFinance\Types\Month $month)
    {
        /**
         * TODO There is a bug in \Respect\Relational when using >= and <= on the same column
         *      https://github.com/Respect/Relational/issues/35
         *      I'll remove this weird $key when it gets fixed
         */

        $key = 'date >= "' . $month->getFirstDay()->format('Y-m-d 00:00:00') . '" AND date <=';

        $conditions = array(
            $key => $month->getLastDay()->format('Y-m-d 23:59:59')
        );

        return $this->fetchConditions($conditions);
    }

    public function fetchPeriod(\DateTime $firstDay, \DateTime $lastDay)
    {
        /**
         * TODO There is a bug in \Respect\Relational when using >= and <= on the same column
         *      https://github.com/Respect/Relational/issues/35
         *      I'll remove this weird $key when it gets fixed
         */

        $key = 'date >= "' . $firstDay->format('Y-m-d 00:00:00') . '" AND date <=';

        $conditions = array(
            $key => $lastDay->format('Y-m-d 23:59:59')
        );

        return $this->fetchConditions($conditions);
    }

    private function fetchConditions(array $conditions)
    {
        $mapper = $this->getMapper();
        return $this->createCollection($mapper->movement($conditions)->fetchAll());
    }

    private function createCollection(array $movements)
    {
        $collection = new \InFog\SimpleFinance\Collections\Movement();

        foreach ($movements as $movement) {
            $collection->add(\InFog\SimpleFinance\Entities\Movement::createFromArray((array) $movement));
        }

        return $collection;
    }

    public function createDTO(\InFog\SimpleFinance\Entities\Movement $movement)
    {
        $dto = new \stdClass();

        $dto->id = $movement->getId();
        $dto->date = $movement->getDate()->format('Y-m-d H:i:s');
        $dto->amount = $movement->getAmount()->getValue();
        $dto->name = $movement->getName()->getValue();
        $dto->description = $movement->getDescription()->getValue();

        return $dto;
    }
}
