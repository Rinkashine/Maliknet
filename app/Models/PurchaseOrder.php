<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order';

    protected $fillable = [
        'suppliers_id',
        'status',
        'shipping_date',
        'tracking',
        'remarks',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() :
        static::query()->where('id', 'like', '%'.$search.'%');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function ordered_items()
    {
        return $this->hasMany(PurchaseOrderItems::class, 'purchase_order_id', 'id');
    }

    public function order_timeline()
    {
        return $this->hasMany(PurchaseOrderTimeline::class, 'purchase_order_id', 'id');
    }
}
