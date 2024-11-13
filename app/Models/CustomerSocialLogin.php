<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSocialLogin extends Model
{
    use HasFactory;
    protected $table = 'customers_social_login';

    protected $fillable = ['customers_id','provider_name', 'provider_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
