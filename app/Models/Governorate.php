<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable = ['id','country_id','name','created_at','updated_at'];

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    
    public function cities():HasMany
    {
        return $this->hasMany(City::class);
    }
}
