<?php

namespace InFog\SimpleFinance\Entities;

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
     * @var \InFog\SimpleFinance\Types\Money
     * @access private
     */
    private $amount;

    /**
     * @var \InFog\SimpleFinance\Types\SmallString
     * @access private
     */
    private $name;

    /**
     * @var \InFog\SimpleFinance\Types\Text
     * @access private
     */
    private $description;

    public static function createFromArray(array $data)
    {
        $movement = new self;

        $movement->setId((isset($data['id'])) ? $data['id'] : null);
        $movement->setDate(new \DateTime($data['date']));
        $movement->setAmount(new \InFog\SimpleFinance\Types\Money($data['amount']));
        $movement->setName(new \InFog\SimpleFinance\Types\SmallString($data['name']));
        $movement->setDescription(new \InFog\SimpleFinance\Types\Text($data['description']));

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

    public function setAmount(\InFog\SimpleFinance\Types\Money $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setName(\InFog\SimpleFinance\Types\SmallString $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription(\InFog\SimpleFinance\Types\Text $description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
