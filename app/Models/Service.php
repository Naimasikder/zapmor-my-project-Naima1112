<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'service_type',
        'description',
        'duration',
        'price',
        'status',
    ];
}