<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $table = 'product_gallery';

    protected $fillable = [
        'product_id',
        'file',
    ];

    public function Product_Image_Transaction()
    {
        return $this->belongsTo(Product::class);
    }
}
