<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Material
 * @package App\Models
 */
class Material extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'material';

    /**
     * ID.
     *
     * @var string
     */
    protected $primaryKey = 'material_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'material_idf',
        'material_title',
        'material_counter_type_id',
    ];

    public function materialcountertype(){
        return $this->belongsTo('App\Models\MaterialCounterType');
    }
    public function materialonconstructions(){
        return $this->hasMany('App\Models\MaterialOnConstruction');
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
