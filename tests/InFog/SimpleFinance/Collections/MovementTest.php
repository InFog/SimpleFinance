<?php

class Movement extends PHPUnit_Framework_TestCase
{
    public function testCreateCollectionAndAddItems()
    {
        $collection = new \InFog\SimpleFinance\Collections\Movement();
        $m = new \InFog\SimpleFinance\Entities\Movement();

        $collection->add($m);

        $expected = 1;
        $result = count($collection);

        $this->assertEquals($expected, $result);
    }
}
