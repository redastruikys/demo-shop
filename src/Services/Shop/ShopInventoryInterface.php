<?php

namespace App\Services\Shop;

use App\Model\Shop\ProductInterface;

interface ShopInventoryInterface
{
    public function addProduct(string $name, int $quantity);

    public function subtractProduct(string $name, int $quantity);

    /**
     * @return array|ProductInterface[]
     */
    public function getProducts(): array;

    public function getProduct(string $name): ?ProductInterface;

    public function productExists(string $name): bool;
}