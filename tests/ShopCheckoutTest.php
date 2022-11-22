<?php

namespace App\Tests;

use App\Services\Shop\ProductBuilder;
use App\Services\Shop\ShopCheckout;
use App\Services\Shop\ShopCheckoutInterface;
use App\Services\Shop\ShopInventory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class ShopCheckoutTest extends WebTestCase
{
    public function testPurchaseProduct()
    {
        $productBuilder = new ProductBuilder();

        $inventory = new ShopInventory($productBuilder);

        $client = new MockHttpClient([
            new MockResponse()
        ]);

        $checkout = new ShopCheckout($inventory, $client);

        $inventory->addProduct('Red ball', 5);

        $status = $checkout->buyProduct('Blue ball', 1);
        $this->assertEquals(ShopCheckoutInterface::STATUS_FAILURE, $status, 'Status should be FAILURE when buying non existing product');

        $status = $checkout->buyProduct('Red ball', 1);
        $this->assertEquals(ShopCheckoutInterface::STATUS_SUCCESS, $status, 'Status should be SUCCESS when buying existing product');
    }
}