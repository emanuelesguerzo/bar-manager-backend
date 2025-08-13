<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Sellable extends Model
{

    protected $fillable = [
        "name",
        "slug",
        "description",
        "price",
        "image",
        "is_visible",
        "category_id",
    ];

    protected $hidden = [
        "pivot",
        "category_id",
        "created_at",
        "updated_at"
    ];

    protected $casts = [
        "is_visible" => "boolean",
        "price" => "decimal:2",
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot("quantity", "unit")
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot("quantity")
            ->withTimestamps();
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }

}
