<?php

namespace InFog\SimpleFinance\Types;

class Money implements Typeable
{
    /**
     * @var float
     * @access private
     */
    private $value;

    /**
     * @var \InFog\SimpleFinance\Types\Money\Config
     * @access private
     */
    private $config;

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
        $this->config = new \InFog\SimpleFinance\Types\Money\Config();
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
