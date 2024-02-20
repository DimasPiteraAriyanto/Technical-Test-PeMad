<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PayOrder extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name_order', 'date_order', 'detail_order', 'total_order', 'status_order'];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, 'order_id', 'id');
    }

}
