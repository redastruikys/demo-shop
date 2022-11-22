<?php

namespace App\Model\Shop;

interface ProductInterface
{
    public function setQuantity(int $quantity);

    public function getQuantity(): int;

    public function increaseQuantity(int $amount);

    public function decreaseQuantity(int $amount);

    public function setName(string $name);

    public function getName(): string;
}