<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes,HasApiTokens,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday',
        'gender', 'address', 'phone_number', 'photo',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%')
        ->orWhere('phone_number', 'like', '%'.$search.'%')
        ->orWhere('address', 'like', '%'.$search.'%');
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

    /**
     * The attributes that appends to returned entities.
     *
     * @var array
     */
    protected $appends = ['photo'];

    /**
     * The getter that return accessible URL for user photo.
     *
     * @var array
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
