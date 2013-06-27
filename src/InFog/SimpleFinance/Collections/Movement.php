<?php

namespace InFog\SimpleFinance\Collections;

class Movement
{

    private $items = array();

    public function add(\InFog\SimpleFinance\Entities\Movement $movement)
    {
        array_push($this->items, $movement);
    }
}
