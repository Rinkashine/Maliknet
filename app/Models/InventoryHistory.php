<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    use HasFactory;

    protected $table = 'inventory_history';

    protected $fillable = [
        'product_id',
        'activity',
        'adjusted_by',
        'operation_value',
        'latest_value',
        'purchase_order_id',
        'customer_order_id'
    ];
}
