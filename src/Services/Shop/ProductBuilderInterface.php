<?php

namespace App\Services\Shop;

use App\Model\Shop\ProductInterface;

interface ProductBuilderInterface
{
    public function build(string $name, int $quantity): ProductInterface;
}