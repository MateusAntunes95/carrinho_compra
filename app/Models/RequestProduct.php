<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'product_id',
        'value',
        'status',
        'discount_doupon_id',
        'discount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
