<?php

namespace InFog\SimpleFinance\Types\Money;

class Config
{
    /**
     * @var string
     * @access private
     */
    private $decimalPoint = '.';

    /**
     * @var string
     * @access private
     */
    private $thousandsSeparator = ',';

    /**
     * @var string
     * @access private
     */
    private $moneySymbol = '$';

    public function setDecimalPoint($decimalPoint)
    {
        if (! is_string($decimalPoint)) {
            throw new \InvalidArgumentException('$decimalPoint must be a string');
        }
        $this->decimalPoint = $decimalPoint;
    }

    public function getDecimalPoint()
    {
        return $this->decimalPoint;
    }

    public function setThousandsSeparator($thousandsSeparator)
    {
        if (! is_string($thousandsSeparator)) {
            throw new \InvalidArgumentException('$thousandsSeparator must be a string');
        }
        $this->thousandsSeparator = $thousandsSeparator;
    }

    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }

    public function setMoneySimbol($moneySymbol)
    {
        if (! is_string($moneySymbol)) {
            throw new \InvalidArgumentException('$moneySymbol must be a string');
        }
        $this->moneySymbol = $moneySymbol;
    }

    public function getMoneySymbol()
    {
        return $this->moneySymbol;
    }
}
