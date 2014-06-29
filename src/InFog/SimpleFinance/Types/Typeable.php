<?php

namespace InFog\SimpleFinance\Types;

interface Typeable
{
    public function getValue();
    public function __toString();
}
