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
     * @var string[20]
     * @access private
     */
    private $name;

    /**
     * @var string[255]
     * @access private
     */
    private $description;

    public static function createFromArray(array $data)
    {
        $movement = new self;

        $movement->setDate($data['date']);
        $movement->setAmount($data['amount']);
        $movement->setName($data['name']);
        $movement->setDescription($data['description']);

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

    public function setName($name)
    {
        if (strlen($name) > 20) {
            throw new \Exception('$name must be 20 chars or less');
        }

        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        if (strlen($description) > 255) {
            throw new \Exception('$description must be 255 chars or less');
        }

        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
