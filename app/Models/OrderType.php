<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'default_display_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
