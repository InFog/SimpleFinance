<?php

namespace InFog\SimpleFinance\Entities;

use \InFog\SimpleFinance\Types\Money;
use \InFog\SimpleFinance\Types\SmallString;
use \InFog\SimpleFinance\Types\Text;

class Movement
{
    /**
     * @var integer
     * @access private
     */
    private $id;

    /**
     * @var DateTime
     * @access private
     */
    private $date;

    /**
     * @var Money
     * @access private
     */
    private $amount;

    /**
     * @var SmallString
     * @access private
     */
    private $name;

    /**
     * @var Text
     * @access private
     */
    private $description;

    public static function createFromArray(array $data)
    {
        $movement = new self;

        $movement->setId((isset($data['id'])) ? $data['id'] : null);
        $movement->setDate(new \DateTime($data['date']));
        $movement->setAmount(new Money($data['amount']));
        $movement->setName(new SmallString($data['name']));
        $movement->setDescription(new Text($data['description']));

        return $movement;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setAmount(Money $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setName(SmallString $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription(Text $description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
