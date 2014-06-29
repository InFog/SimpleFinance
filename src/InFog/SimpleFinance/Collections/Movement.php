<?php

namespace InFog\SimpleFinance\Collections;

use \InFog\SimpleFinance\Entities\Movement as MovementEntity;

class Movement implements \Countable, \IteratorAggregate
{

    private $items = array();

    public function add(MovementEntity $movement)
    {
        array_push($this->items, $movement);
    }

    public function count()
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
