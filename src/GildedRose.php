<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) 
        {
            $item->sellIn = $item->sellIn - 1;
            $this->updateItem($item);      
        }
    }
    public function updateItem(Item $item): void
    {
        switch ($item->name) 
            {
                case ('Sulfuras, Hand of Ragnaros'):
                {
                    $this->updateSulfuras($item);
                    break;
                }
                case ('Aged Brie'):
                {
                    $this->updateAgedBrie($item);
                    break;
                }
                case ('Backstage passes to a TAFKAL80ETC concert'):
                {
                    $this->updateBackstage($item);
                    break;
                } 
 
                default:
                {
                    $this->updateDefault($item);
                }
            }
    }
    public function updateAgedBrie(Item $item): void
    {
        if ($item->sellIn < 0 and $item->quality < 50)
        {
            $item->quality = $item->quality + 1;
        }
        if ($item->quality < 50) 
        {
            $item->quality = $item->quality + 1;
        }
    }

    public function updateBackstage(Item $item): void
    {
        if ($item->quality < 50) 
        {
            $item->quality = $item->quality + 1;
            if ($item->sellIn < 10) 
            {
                $item->quality = $item->quality + 1;  
            }
            if ($item->sellIn < 5) 
            {
                $item->quality = $item->quality + 1;
            }
        }
        if ($item->sellIn < 0)
        {
            $item->quality = 0;
        }
    }

    public function updateSulfuras(Item $item): void
    {
        $item->sellIn = $item->sellIn + 1;
    }

    public function updateDefault(Item $item): void
    {
        if ($item->quality > 0) 
                {
                    if ($item->sellIn < 0)
                    {
                        $item->quality = $item->quality - 1;
                    }
                    $item->quality = $item->quality - 1;
                }
    }

    }

