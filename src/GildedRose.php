<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(private array $items) 
    {    }

    public function updateQuality(): void
    {
        if (empty($this->items)) 
        {
            return;
        }
        foreach ($this->items as $item) 
        {
            $item->sellIn--;
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
                case ('Conjred Mana Cake'):
                    {
                        $this->updateConjred($item);
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
            $item->quality++;
        }
        if ($item->quality < 50) 
        {
            $item->quality++;
        }
    }

    public function updateBackstage(Item $item): void
    {
        if ($item->quality < 50 && $item->sellIn >= 0) {
            $item->quality += ($item->sellIn < 5) ? 3 : (($item->sellIn < 10) ? 2 : 1);
        }
        elseif ($item->sellIn < 0) {
            $item->quality = 0;
        }
        
    }

    public function updateSulfuras(Item $item): void
    {
        $item->sellIn++;
    }
    public function updateConjred(Item $item): void
    {
        if ($item->quality > 0 && $item->sellIn < 0) {
            $item->quality -= 4;
        } elseif ($item->quality > 0) {
            $item->quality -= 2;
        }
    }

    public function updateDefault(Item $item): void
    {
        if ($item->quality > 0 && $item->sellIn < 0) 
        {
            $item->quality -= 2;
        } 
        elseif ($item->quality > 0) 
        {
            $item->quality -= 1;
        }
    }
    

    }

