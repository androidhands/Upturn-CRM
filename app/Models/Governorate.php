<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = ['id','country_id','name','created_at','updated_at'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
