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
    public function testAgedBrieAfterSellInDate(): void    
    {
        $items = [new Item('Aged Brie', -5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -6);
        $this->assertEquals($items[0]->quality, 12);
    }
    public function testAgedBrieNearMaximumQuality(): void    
    {
        $items = [new Item('Aged Brie', 0, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -1);
        $this->assertEquals($items[0]->quality, 50);
    }
    public function BackstagePassesBeforeSellInDate(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 9);
        $this->assertEquals($items[0]->quality, 12);
    }
    public function BackstagePassesMoreThan10DaysBeforeSellInDate(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 11, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 10);
        $this->assertEquals($items[0]->quality, 11);
    }
    public function BackstagePassesfiveDaysBeforeSellInDate(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 4);
        $this->assertEquals($items[0]->quality, 13);
    }
    public function BackstagePassesSellInDate(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -1);
        $this->assertEquals($items[0]->quality, 0);
    }
    public function BackstagePassesCloseToSellInDateWithMaximumQuality(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 9);
        $this->assertEquals($items[0]->quality, 50);
    }
    public function BackstagePassesVeryCloseToSellInDateWithMaximumQuality(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 4);
        $this->assertEquals($items[0]->quality, 50);
    }
    public function BackstagePassesAfterSellInDate(): void    
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, -6);
        $this->assertEquals($items[0]->quality, 0);
    }

}
