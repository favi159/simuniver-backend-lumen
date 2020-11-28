<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'material';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'slug', 
        'descripcion', 
        'precio', 
        'foto', 
        'tiempoReferencial', 
        'state_id', 
        'user_id', 
        'condition_id', 
        'type_id'
    ]; 

    public function incrementSlug($slug) {

        $original = $slug;    
                
        while (static::whereSlug($slug)->exists() and $slug != $this->attributes['slug']) {
            
            $slug = "{$original}" . rand(1000);
        }
    
        return $slug;
    
    }

    public function setNombreAttribute($value)
	{
        $this->attributes['texto2'] = $value;

        if (static::whereSlug($slug = str_slug($value))->exists()) {
        
            $slug = $this->incrementSlug($slug);
        }

		$this->attributes['slug'] = $slug;
    }
    
    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }


    public function getCondition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }

    public function getType()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function getCareers()
	{
		return $this->belongsToMany(Career::class, 'material_career', 'material_id', 'career_id');
    }

    public function getCategories()
	{
		return $this->belongsToMany(Category::class, 'material_category', 'material_id', 'category_id');
    }
    
}
