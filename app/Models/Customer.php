<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'birthday',
        'photo',
        'gender',
        'email_verified_at',
        'provider',
        'provider_id',
        'provider_token'
    ];

    public function customershippingaddress()
    {
        return $this->hasMany(CustomerShippingAddress::class, 'customer_id', 'id');
    }

    public function customerscart()
    {
        return $this->hasMany(CustomerCart::class, 'customer_id', 'id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%')
        ->orWhere('phone_number', 'like', '%'.$search.'%');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function socialAccounts()
    {
        return $this->hasMany(CustomerSocialLogin::class,'customers_id', 'id');
    }

    /**
     * The getter that return accessible URL for user photo.
     *
     * @var array
     */

}
