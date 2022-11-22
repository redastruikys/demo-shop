<?php

namespace App\Tests;

use App\Services\Shop\ProductBuilder;
use App\Services\Shop\ShopInventory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShopInventoryTest extends WebTestCase
{
    public function testAddProduct()
    {
        $productBuilder = new ProductBuilder();
        $inventory = new ShopInventory($productBuilder);

        $inventory->addProduct('T-Shirt', 1);

        $this->assertCount(1, $inventory->getProducts(), 'There should be 1 item in inventory');

        $inventory->addProduct('Hat', 1);
        $this->assertCount(2, $inventory->getProducts(), 'There should be 2 items in inventory');

        $inventory->addProduct('Hat', 10);
        $this->assertCount(2, $inventory->getProducts(), 'There should be 2 items with the same name in inventory');

        $productHat = $inventory->getProduct('Hat');

        $this->assertNotNull($productHat, 'Inventory should have product named Hat');

        $this->assertEquals(11, $productHat->getQuantity(), 'The total quantity of product named "Had" should be 11');
    }

    public function testSubtractProducts()
    {
        $productBuilder = new ProductBuilder();
        $inventory = new ShopInventory($productBuilder);

        $inventory->addProduct('T-Shirt', 10);
        $inventory->subtractProduct('T-Shirt', 1);

        $productTshirt = $inventory->getProduct('T-Shirt');

        $this->assertNotNull($productTshirt, 'There should be product named "T-Shirt" in inventory');

        $this->assertEquals(9, $productTshirt->getQuantity(), 'The total quantity of product named "T-Shirt" should be 9');

        $inventory->subtractProduct('T-Shirt', 1);
        $inventory->subtractProduct('T-Shirt', 2);

        $this->assertEquals(6, $productTshirt->getQuantity(), 'The total quantity of product named "T-Shirt" after subtraction by 1+2 should be 6');
    }
}