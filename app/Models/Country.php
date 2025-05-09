<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','code','phoneCode','flagUrl','created_at','updated_at'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function governorates():HasMany
    {
        return $this->hasMany(Governorate::class);
    }
   
}
