<?php

declare(strict_types=1);

namespace GildedRose;

class BackstageUpdater implements ItemUpdater
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality < 50 && $item->sellIn >= 0) {
            $item->quality += ($item->sellIn < 5) ? 3 : (($item->sellIn < 10) ? 2 : 1);
        } elseif ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }
}