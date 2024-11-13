<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    protected $table = 'purchase_order_items';

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'accepted_quantity',
        'price',
        'discount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
