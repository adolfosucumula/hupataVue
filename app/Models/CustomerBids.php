<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBids extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'presentation_letter',
        'presentation_file',
        'tax_per_hour',
        'app_tax',
        'tax_to_receive',
        'days',
        'created_at',
        'updated_at'
    ];
}
