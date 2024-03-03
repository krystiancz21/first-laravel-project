<?php

namespace App\ValueObjects;

use App\Models\Product;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Traits\EnumeratesValues;

class Cart
{
    private Collection $items;

    /**
     * @param Collection|null $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function hasItems(): Bool
    {
        return $this->items->isNotEmpty();
    }


    public function getSum(): float
    {
        return $this->items->sum(function ($item) {
            return $item->getSum();
        });
    }

    public function getQuantity(): int
    {
        return $this->items->sum(function ($item) {
            return $item->getQuantity();
        });
    }

    public function addItem(Product $product): Cart
    {
        $items = $this->items;
        $item = $items->first($this->isProductIdSameAsItemProduct($product));
        if (!is_null($item)) {
            $items = $this->removeItemFromCollection($items, $product);
            $newItem = $item->addQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }
        $items->add($newItem);
        return new Cart($items);
    }

    public function removeItem(Product $product): Cart
    {
        $items = $this->removeItemFromCollection($this->items, $product);
        return new Cart($items);
    }

    /**
     * @param Product $product
     * @return Closure
     */
    public function isProductIdSameAsItemProduct(Product $product): Closure
    {
        return function ($item) use ($product) {
            return $product->id == $item->getProductId();
        };
    }

    /**
     * @param Collection|EnumeratesValues $items
     * @param Product $product
     * @return Collection|EnumeratesValues
     */
    public function removeItemFromCollection(Collection|EnumeratesValues $items, Product $product): Collection|EnumeratesValues
    {
        return $items->reject($this->isProductIdSameAsItemProduct($product));
    }
}
