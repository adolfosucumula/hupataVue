<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'detail',
        'requirements',
        'tax_per_hour',
        'total_tax',
        'time_required',
        'preferences',
        'currency',
        'created_at',
        'updated_at'
    ];
}
