<?php

declare(strict_types=1);

namespace GildedRose;


class ConjredUpdater implements ItemUpdater
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality > 0 && $item->sellIn < 0) {
            $item->quality -= 4;
        } elseif ($item->quality > 0) {
            $item->quality -= 2;
        }
    }
}