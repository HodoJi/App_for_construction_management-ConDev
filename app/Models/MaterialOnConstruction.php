<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class MaterialOnConstruction
 * @package App\Models
 */
class MaterialOnConstruction extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'material_on_construction';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'construction_id',
        'material_id',
        'stock_count',
    ];

    public function construction(){
        return $this->belongsTo('App\Models\Construction');
    }

    public function material(){
        return $this->belongsTo('App\Models\Material');
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
