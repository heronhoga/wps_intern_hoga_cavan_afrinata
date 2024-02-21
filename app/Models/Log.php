<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'description',
        'photourl',
        'status',
        'user_id',
        'supervisor_id',
        'supervisor',
    ];

}
