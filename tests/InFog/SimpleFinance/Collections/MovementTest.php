<?php

namespace tests\InFog\SimpleFinance\Collections;

class MovementTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCollectionAddAndCountItems()
    {
        $collection = new \InFog\SimpleFinance\Collections\Movement();
        $m = new \InFog\SimpleFinance\Entities\Movement();
        $collection->add($m);

        $expected = 1;
        $result = count($collection);
        $this->assertEquals($expected, $result);

        $m = new \InFog\SimpleFinance\Entities\Movement();
        $collection->add($m);

        $expected = 2;
        $result = count($collection);
        $this->assertEquals($expected, $result);
    }

    public function testCreateCollectionAndIterateOverIt()
    {
        $collection = new \InFog\SimpleFinance\Collections\Movement();

        $m1 = new \InFog\SimpleFinance\Entities\Movement();
        $m1->setName(new \InFog\SimpleFinance\Types\SmallString('First Movement'));
        $m2 = new \InFog\SimpleFinance\Entities\Movement();
        $m2->setName(new \InFog\SimpleFinance\Types\SmallString('Second Movement'));

        $collection->add($m1);
        $collection->add($m2);

        $expected = array(
            "First Movement",
            "Second Movement"
        );

        $result = array();

        foreach ($collection as $m) {
            $result[] = "{$m->getName()}";
        }

        $this->assertEquals($expected, $result);
    }
}
