<?php

namespace App\Services\Shop;

use App\Model\Shop\Product;
use App\Model\Shop\ProductInterface;

class ProductBuilder implements ProductBuilderInterface
{
    public function build(string $name, int $quantity): ProductInterface
    {
        return new Product($name, $quantity);
    }
}