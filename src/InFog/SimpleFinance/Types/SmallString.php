<?php

namespace InFog\SimpleFinance\Types;

class SmallString
{
    /**
     * @var string
     * @access private
     */
    private $value;

    public function __construct($value)
    {
        if (! is_string($value)) {
            throw new \InvalidArgumentException('$value must be string!');
        }
        if (strlen($value) > 20) {
            throw new \LengthException('$value must be 20 chars or less');
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
