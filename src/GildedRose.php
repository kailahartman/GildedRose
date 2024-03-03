<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(private array $items)
    {
    }

    public function updateQuality(): void
    {
        if (empty($this->items)) {
            return;
        }
        
        foreach ($this->items as $item) {
            $item->sellIn--;
            $this->updateItem($item);
        }
    }

    public function updateItem(Item $item): void
    {
        switch ($item->name) {
            case 'Sulfuras, Hand of Ragnaros':
                $updater = new SulfurasUpdater();
                break;
            case 'Aged Brie':
                $updater = new AgedBrieUpdater();
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                $updater = new BackstageUpdater();
                break;
            case 'Conjred Mana Cake':
                $updater = new ConjredUpdater();
                break;
            default:
                $updater = new DefaultUpdater();
                break;
        }
        
        $updater->updateQuality($item);
    }
}
