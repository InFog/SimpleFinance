<?php

namespace InFog\SimpleFinance\Repositories;

use \Respect\Relational\Mapper;

class Movement
{
    /**
     * @var $pdo \PDO
     */
    private static $pdo;

    /**
     * @var $mapper \Respect\Relational\Mapper
     */
    private static $mapper;

    public static function setPdo(\Pdo $pdo)
    {
        self::$pdo = $pdo;
    }

    private static function getPdo()
    {
        if (! self::$pdo) {
            self::$pdo = new \PDO(PDO_DSN);
        }

        return self::$pdo;
    }

    private static function getMapper()
    {
        if (! self::$mapper) {
            self::$mapper = new Mapper(self::getPdo());
            self::$mapper->entityNamespace = '\\InFog\\SimpleFinance\\Entities';
        }

        return self::$mapper;
    }

    public static function save(\InFog\SimpleFinance\Entities\Movement $movement)
    {
        $movementDTO = self::createDTO($movement);

        $mapper = self::getMapper();
        $mapper->movement->persist($movementDTO);
        $mapper->flush();

        return $movementDTO->id;
    }

    public static function fetch(array $conditions)
    {
        $mapper = self::getMapper();
        $movementDTO = $mapper->movement($conditions)->fetch();

        return \InFog\SimpleFinance\Entities\Movement::createFromArray(
            (array) $movementDTO
        );
    }

    public static function fetchAll(array $conditions = null)
    {
        if (is_array($conditions)) {
            return self::fetchConditions($conditions);
        }

        $mapper = self::getMapper();
        return self::createCollection($mapper->movement->fetchAll());
    }

    public static function fetchMonth(\InFog\SimpleFinance\Types\Month $month)
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

        return self::fetchConditions($conditions);
    }

    public static function fetchPeriod(\DateTime $firstDay, \DateTime $lastDay)
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

        return self::fetchConditions($conditions);
    }

    private static function fetchConditions(array $conditions)
    {
        $mapper = self::getMapper();
        return self::createCollection($mapper->movement($conditions)->fetchAll());
    }

    private static function createCollection(array $movements)
    {
        $collection = new \InFog\SimpleFinance\Collections\Movement();

        foreach ($movements as $movement) {
            $collection->add(\InFog\SimpleFinance\Entities\Movement::createFromArray((array) $movement));
        }

        return $collection;
    }

    public static function createDTO(\InFog\SimpleFinance\Entities\Movement $movement)
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
