<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value',
        'image',
        'active',
    ];

    protected $attributes = [
        'active' => 1,
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(',', '.', $value);
    }

}
