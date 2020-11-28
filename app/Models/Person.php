<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'person';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 
        'nombres', 
        'aPaterno', 
        'aMaterno', 
        'fecNacimiento', 
        'email', 
        'telefono', 
        'celular', 
        'career_id', 
        'foto',
        'user_id'
    ]; 

    public function getCareer()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    
    
}
