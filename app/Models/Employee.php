<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'role_id', 'department_id', 'date_of_birth', 'gender', 'education_degree', 'graduation_year', 'military_status', 'marital_status', 'hiring_date', 'termination_date', 'created_at', 'updated_at', 'is_active', 'image_url'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
