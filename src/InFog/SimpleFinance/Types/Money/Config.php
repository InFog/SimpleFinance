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

    public function setMoneySimbol($moneySymbol)
    {
        $this->moneySymbol = $moneySymbol;
    }

    public function getMoneySymbol()
    {
        return $this->moneySymbol;
    }
}
