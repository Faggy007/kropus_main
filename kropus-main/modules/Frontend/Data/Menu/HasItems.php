<?php

namespace Modules\Frontend\Data\Menu;

use Illuminate\Support\Collection;

trait HasItems
{
    public ?Collection $items = null;

    public function addItemToBegin(MenuItem $item): static
    {
        if ($this->items === null) {
            $this->items = new Collection();
        }
        $this->items->prepend($item);
        return $this;
    }

    public function items(Collection $items): static
    {
        $this->items = $items;
        return $this;
    }

    public function hasItems(): bool
    {
        return $this->items !== null && $this->items->isNotEmpty();
    }
}
