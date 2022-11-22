<?php

namespace App\Services\Shop;

interface ShopCheckoutInterface
{
    const STATUS_FAILURE = 0;

    const STATUS_SUCCESS = 1;

    public function buyProduct(string $name, int $quantity): int;
}