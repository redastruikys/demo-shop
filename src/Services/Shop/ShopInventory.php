<?php

namespace App\Services\Shop;

use App\Model\Shop\Product;
use App\Model\Shop\ProductInterface;

class ShopInventory implements ShopInventoryInterface
{
    private ProductBuilderInterface $productBuilder;

    public function __construct(ProductBuilderInterface $productBuilder)
    {
        $this->productBuilder = $productBuilder;
    }

    /**
     * @var array|Product|ProductInterface[]
     */
    private array $products = [];

    public function addProduct(string $name, int $quantity)
    {
        if (isset($this->products[$name])) {
            $this->products[$name]->increaseQuantity($quantity);
        } else {
            $this->products[$name] = $this->productBuilder->build($name, $quantity);
        }
    }

    public function subtractProduct(string $name, int $quantity)
    {
        if (isset($this->products[$name])) {
            $this->products[$name]->decreaseQuantity($quantity);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProduct(string $name): ?ProductInterface
    {
        return $this->products[$name] ?? null;
    }

    public function productExists(string $name): bool
    {
        return $this->getProduct($name) !== null;
    }
}