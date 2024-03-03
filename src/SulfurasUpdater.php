<?php

declare(strict_types=1);

namespace GildedRose;

class SulfurasUpdater implements ItemUpdater
{
    public function updateQuality(Item $item): void
    {
        $item->sellIn++;
    }
}