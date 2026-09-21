<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function parlors(): BelongsToMany
    {
        return $this->belongsToMany(
            Parlor::class,
            'parlor_services',
            'service_id',
            'parlor_id'
        );
    }
}