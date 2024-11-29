<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','industry','type','logoUrl','created_at','updated_at'];
    public function countries():BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function roles():HasMany
    {
        return $this->hasMany(Role::class);
    }
    
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function businessUnits():HasMany
    {
        return $this->hasMany(BusinessUnit::class);
    }

    public function regions():HasMany
    {
        return $this->hasMany(Region::class);
    }

    public function districts():HasMany
    {
        return $this->hasMany(District::class);
    }

    public function territories():HasMany
    {
        return $this->hasMany(Territory::class);
    }

    public function lines():HasMany
    {
        return $this->hasMany(Line::class);
    }
}
