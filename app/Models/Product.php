<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'status',
        'description',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%');
    }


     public function category()
     {
         return $this->belongsTo(Category::class);
     }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function ProductTransaction()
    {
        return $this->hasMany(CustomerCart::class);
    }
}
