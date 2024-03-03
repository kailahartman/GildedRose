<?php

declare(strict_types=1);

namespace GildedRose;


class AgedBrieUpdater implements ItemUpdater
{
    public function updateQuality(Item $item): void
    {
        if ($item->sellIn < 0 && $item->quality < 50) {
            $item->quality++;
        }
        if ($item->quality < 50) {
            $item->quality++;
        }
    }
}




