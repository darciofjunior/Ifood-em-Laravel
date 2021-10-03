<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $productRepository, $tableRepository, $tenantRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        TableRepositoryInterface $tableRepository,
        TenantRepositoryInterface $tenantRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function ordersByClient()
    {
        $idClient = $this->getClientIdByOrder();

        return $this->orderRepository->getOrdersByClient($idClient);
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function getOrdersByTenantId(int $idTenant, string $status)
    {
        return $this->orderRepository->getOrdersByTenantId($idTenant, $status);
    }

    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);

        $identify = $this->getIdentifyOrder(8);
        $total = $this->getTotalOrder($productsOrder);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;
    }

    private function getIdentifyOrder(int $qtyCaracteres = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers.= 1234567890;

        $characteres = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characteres), 0, $qtyCaracteres);

        if($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaracteres + 1);
        }

        return $identify;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);

            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price,
            ]);
        }

        return $products;
    }

    private function getTotalOrder(array $products): float
    {
        $total = 0;

        foreach ($products as $product) {
            $total+= ($product['price'] * $product['qty']);
        }

        return (float) $total;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if($uuid) {
            $table = $this->tenantRepository->getTenantByUuid($uuid);

            return $table->id;
        }

        return '';
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $tenant->id;
    }

    private function getClientIdByOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
}
