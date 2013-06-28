<?php

namespace InFog\SimpleFinance\Types;

class Money
{
    /**
     * @var float
     * @access private
     */
    private $value;

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

    public function __construct($value, \InFog\SimpleFinance\Types\Money\Config $config = null)
    {
        if (! is_numeric($value)) {
            throw new \InvalidArgumentException('$value must be numeric!');
        }
        $this->value = $value;
        $this->setConfig($config);
    }

    public function setConfig(\InFog\SimpleFinance\Types\Money\Config $config = null)
    {
        if ($config) {
            $this->decimalPoint = $config->getDecimalPoint();
            $this->thousandsSeparator = $config->getThousandsSeparator();
            $this->moneySymbol = $config->getMoneySymbol();
        }
    }

    public function __toString()
    {
        return $this->moneySymbol . ' ' . number_format($this->value, 2,
            $this->decimalPoint, $this->thousandsSeparator
        );
    }
}
