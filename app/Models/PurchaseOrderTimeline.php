<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderTimeline extends Model
{
    protected $table = 'purchase_order_timeline';

    protected $fillable = [
        'title',
        'purchase_order_id',
    ];
}
