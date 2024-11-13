<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItems extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'customer_order_item';

    protected $fillable = [
        'customer_order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
    ];

    public function customer_orders()
    {
        return $this->belongsTo(CustomerOrder::class);
    }

    public function reviewTransactions()
    {
        return $this->hasMany(Review::class, 'customer_order_item_id', 'id');
    }
}
