<?php

declare(strict_types=1);

namespace GildedRose;

interface ItemUpdater
{
    public function updateQuality(Item $item): void;
}