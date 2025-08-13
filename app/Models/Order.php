<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "table_number",
        "status",
    ];

    protected $casts = [
        'table_number' => 'integer',
        'status'       => 'string',
    ];

    public function sellables()
    {
        return $this->belongsToMany(Sellable::class)
            ->withPivot("quantity")
            ->withTimestamps();
    }
}
