<?php
namespace App\Repositories;

use App\Models\PurchaseOrder;

class PurchaseOrderRepository
{
    protected $model;

    public function __construct(PurchaseOrder $purchaseOrder)
    {
        $this->model = $purchaseOrder;
    }

    public function all()
    {
        return $this->model->all();
    }
}
