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
}
