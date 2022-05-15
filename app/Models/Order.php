<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Order extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'material_id',
        'construction_id',
        'amount'
    ];

    public function users(){
        return $this->belongsTo('App\Models\User');
    }
    public function statuses(){
        return $this->belongsTo('App\Models\Status');
    }
    public function materials(){
        return $this->belongsTo('App\Models\Material');
    }
    public function constructions(){
        return $this->belongsTo('App\Models\Construction');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

}


