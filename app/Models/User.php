<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'personalId',
        'construction_id',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    // Checks user role
    public function hasRole($user_id, $role_id)
    {
        return User::where('role_id', $role_id)->where('id', $user_id)->get();
    }
}
