<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'product_review';

    protected $fillable = [
        'customer_id',
        'customer_order_item_id',
        'customer_order_id',
        'comment',
        'rate',
        'customer_id',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
     public function reviewTransactions()
    {
        return $this->hasOne(CustomerOrderItems::class,'id','customer_order_item_id');
    }

    public function customer_reviews()
    {
        return $this->belongsTo(CustomerOrderItems::class);
    }
}
