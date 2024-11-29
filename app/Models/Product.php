<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'price', 'code', 'package', 'unit', 'imageUrl', 'created_at', 'updated_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
