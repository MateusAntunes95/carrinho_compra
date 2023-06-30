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
        'limit',
        'expiration_date',
        'active',
    ];


}
