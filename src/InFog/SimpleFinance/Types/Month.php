<?php

namespace InFog\SimpleFinance\Types;

class Month implements Typeable
{
    /**
     * @var integer
     * @access private
     */
    private $year;

    /**
     * @var integer
     * @access private
     */
    private $month;

    public function __construct($year, $month)
    {
        if (! is_numeric($year)) {
            throw new \InvalidArgumentException('$year must be an integer');
        }
        if (! is_numeric($month)) {
            throw new \InvalidArgumentException('$month must be an integer');
        }

        $this->year = $year;
        $this->month = $month;
    }

    public function getValue()
    {
        $month = str_pad($this->month, 2, '0', STR_PAD_LEFT);
        return "{$this->year}-{$month}";
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getFirstDay()
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function getLastDay()
    {
        $lastDay = $this->getFirstDay();
        $lastDay = $lastDay->format('t');

        return new \DateTime("{$this->year}-{$this->month}-{$lastDay}");
    }
}
