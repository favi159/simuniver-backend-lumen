<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comentario', 
        'type_id', 
        'user_id', 
        'material_id',
        'aceptada'
    ]; 

    public function getType()
    {
        return $this->belongsTo(Type::class, 'type_id');
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
}
