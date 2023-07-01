<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountDoupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'locator',
        'discount',
        'expiration_date',
        'active',
        'limit',
    ];

    protected $attributes = [
        'active' => 1,
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
