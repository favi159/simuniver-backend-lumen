<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'condition';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'color',
        'slug',
        'orden'
    ];    

    public function setNombreAttribute($value)
	{
        $this->attributes['nombre'] = $value;
		$this->attributes['slug'] = str_slug($value, '-');
    }

    public function getMaterials()
    {
        return $this->hasMany(Material::class);
    }

}
