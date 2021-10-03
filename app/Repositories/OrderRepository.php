<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = ''
    ) {
        $data = [
            'tenant_id' => $tenantId,
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
        ];

        if($clientId) $data['clientId'] = $clientId;
        if($tableId) $data['tableId'] = $tableId;
        
        $order = $this->entity->create($data);

        return $order;
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity
                    ->where('identify', $identify)
                    ->first();
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        $orderProducts = [];

        $order = $this->entity->find($orderId);

        foreach($products as $product) {
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price'],
            ];
        }

        $order->products()->attach($orderProducts);

        // foreach ($products as $product) {
        //     array_push($orderProducts, [
        //         'order_id' => $orderId,
        //         'product_id' => $product['id'],
        //         'qty' => $product['qty'],
        //         'price' => $product['price'],
        //     ]);
        // }

        // DB::table('order_product')->insert($orderProducts);
    }

    public function getOrdersByClient(int $idClient)
    {
        $orders = $this->entity
                        ->where('client_id', $idClient)
                        ->paginate();

        return $orders;
    }
}
