<?php

namespace InFog\SimpleFinance\Types;

class Money
{
    /**
     * @var float
     * @access private
     */
    private $value;

    public function __construct($value)
    {
        if (! is_numeric($value)) {
            throw new \InvalidArgumentException('$value must be numeric!');
        }
        $this->value = $value;
    }
}
