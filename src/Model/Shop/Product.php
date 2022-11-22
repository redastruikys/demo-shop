<?php

namespace App\Model\Shop;

class Product implements ProductInterface
{
    private string $name;

    private int $quantity;

    public function __construct(string $name, int $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function increaseQuantity(int $amount = 1)
    {
        $this->quantity += $amount;
    }

    public function decreaseQuantity(int $amount = 1)
    {
        $this->quantity -= $amount;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}