<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Request extends Model
{
    use HasFactory;

    public function request_products()
    {
        return $this->hasMany(RequestProduct::class)
            ->select(DB::raw('product_id, sum(discount) as discounts, sum(value) as total_value, count(1) as quantity'))
            ->groupBy('product_id')
            ->orderBy('product_id', 'desc');
    }
}
