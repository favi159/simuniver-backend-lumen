<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'material_id', 
        'fecInicio', 
        'fecFin', 
        'fecDevolucion', 
        'concluida', 
        'place_id'
    ]; 

    public function getState()
    {
        return $this->belongsTo(State::class, 'states_id');
    }
    
    //este usuario es el que solicita el material
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMaterial()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function getPlace()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
