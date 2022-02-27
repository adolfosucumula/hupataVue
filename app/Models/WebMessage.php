<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebMessage extends Model
{
    use HasFactory;

    protected $table = 'web_message';

    protected $fillable = [
        'name',
        'email',
        'cellphone',
        'subject',
        'message'
    ];

}
