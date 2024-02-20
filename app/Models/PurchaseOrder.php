<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','total_purchase_order','status_purchase_order'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
