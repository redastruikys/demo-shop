<?php

namespace App\Services\Shop;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ShopCheckout implements ShopCheckoutInterface
{
    private ShopInventoryInterface $inventory;
    private HttpClientInterface $client;

    public function __construct(ShopInventoryInterface $inventory, HttpClientInterface $client)
    {
        $this->inventory = $inventory;
        $this->client = $client;
    }

    public function buyProduct(string $name, int $quantity): int
    {
        if ($this->inventory->productExists($name)) {
            $this->inventory->subtractProduct($name, $quantity);

            if ($this->sendPurchaseReport($name, $quantity)) {
                return self::STATUS_SUCCESS;
            }
        }

        return self::STATUS_FAILURE;
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendPurchaseReport(string $name, int $quantity): bool
    {
        $response = $this->client->request('POST', 'https://localhost/report-purchase', [
            'body' => [
                'product' => [
                    'name' => $name,
                    'quantity' => $quantity
                ]
            ]
        ]);

        return $response->getStatusCode() === 200;
    }
}