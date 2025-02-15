<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'company_id', 'name', 'level', 'created_at', 'updated_at'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
