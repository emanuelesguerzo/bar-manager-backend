<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $fillable = [
        "product_id",
        "quantity",
        "unit",
        "expiration_date",
        "received_at",
    ];

    protected $casts = [
        "quantity"        => "integer",
        "expiration_date" => "date",
        "received_at"     => "datetime",
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
