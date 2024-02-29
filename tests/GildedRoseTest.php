<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    // public function testFoo(): void
    // {
    //     $items = [new Item('foo', 0, 0)];
    //     $gildedRose = new GildedRose($items);
    //     $gildedRose->updateQuality();
    //     $this->assertSame('fixme', $items[0]->name);
    // }
    public function testAgedBrieAtBeginning(): void      
    {
        $items = [new Item('Aged Brie', 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 1);
        $this->assertEquals($items[0]->quality, 1);
    }

    public function testAgedBrieWhenSellInZero(): void
    {
        $items = [new Item('Aged Brie', 0, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -1);
        $this->assertEquals($items[0]->quality, 4);
    }

    public function testAgedBrieDontIncreaseMaximum(): void    
    {
        $items = [new Item('Aged Brie', -28, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -29);
        $this->assertEquals($items[0]->quality, 50);
    }

}
