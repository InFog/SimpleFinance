<?php

namespace InFog\SimpleFinance\Collections;

class Movement implements \Countable, \IteratorAggregate
{

    private $items = array();

    public function add(\InFog\SimpleFinance\Entities\Movement $movement)
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
