<?php

namespace InFog\SimpleFinance\Types;

use \InFog\SimpleFinance\Types\Money\Config as MoneyConfig;

class Money implements Typeable
{
    /**
     * @var float
     * @access private
     */
    private $value;

    /**
     * @var MoneyConfig
     * @access private
     */
    private $config;

    public function __construct($value, MoneyConfig $config = null)
    {
        if (! is_numeric($value)) {
            throw new \InvalidArgumentException('$value must be numeric!');
        }
        $this->value = $value;
        $this->setConfig($config);
    }

    public function setConfig(MoneyConfig $config = null)
    {
        $this->config = new MoneyConfig();
        if ($config) {
            $this->config = $config;
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->config->getMoneySymbol() . ' ' . number_format($this->value, 2,
            $this->config->getDecimalPoint(), $this->config->getThousandsSeparator()
        );
    }
}
