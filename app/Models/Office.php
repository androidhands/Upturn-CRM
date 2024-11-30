<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['id','company_id','name','governorate','city','street','phone','created_at','updated_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
