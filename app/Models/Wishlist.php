<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'customers_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

     public function customers()
     {
         return $this->belongsTo(Customer::class);
     }
}
