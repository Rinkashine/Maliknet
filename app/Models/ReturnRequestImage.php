<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequestImage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'return_request_photo';

    protected $fillable = [
        'customer_order_id',
        'images',
        ];
}
