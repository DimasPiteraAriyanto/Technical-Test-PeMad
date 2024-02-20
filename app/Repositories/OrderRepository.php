<?php

namespace App\Repositories;


use App\Models\PayOrder;
use App\Models\PurchaseOrder;
use Illuminate\Support\Str;

class OrderRepository
{
    protected $model;

    public function __construct(PayOrder $order)
    {
        $this->model = $order;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getId($id)
    {
        return $this->model->findOrFail($id);
    }

    public function search($filters)
    {
        $query = PayOrder::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_order', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return PayOrder::create($data);
    }

    public function update(array $data, PayOrder $order)
    {
        // Update order data
        $order->update($data);

        return $order;
    }

    public function delete(PayOrder $order)
    {
        $order->delete();
    }

    public function createOrderWithPurchaseOrders(array $orderData, array $nameOrders)
    {
        // Create a new order
        $order = PayOrder::create($orderData);


        // Save the first name_order separately
        if (!empty($nameOrders)) {
            $first_name_order = array_shift($nameOrders);
            PurchaseOrder::create([
                'order_id' => $order->id,
                'total_purchase_order' => $orderData['total_order'],
                'status_purchase_order' => $orderData['status_order'],
                'name_order' => $first_name_order,
            ]);
        }

        // Save the remaining name_order values
        foreach ($nameOrders as $name) {
            PurchaseOrder::create([
                'order_id' => $order->id,
                'total_purchase_order' => $orderData['total_order'],
                'status_purchase_order' => $orderData['status_order'],
                'name_order' => $name,
            ]);
        }

        return $order;
    }

}
