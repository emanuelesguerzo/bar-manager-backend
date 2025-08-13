<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $casts = [
        'price' => 'decimal:2',
        'unit_size_ml' => 'integer',
        'unit_size_g' => 'integer',
        'stock_alert_threshold' => 'integer',
    ];

    protected $fillable = [
        "name",
        "slug",
        "brand",
        "price",
        "unit_size_ml",
        "unit_size_g",
        "image",
        "supplier_id",
        "stock_alert_threshold",
    ];

    protected $hidden = [
        "pivot",
        "created_at",
        "updated_at",
        "price",
        "unit_size_ml",
        "unit_size_g",
        "supplier_id",
        "id",
        "stock_alert_threshold",
    ];

    protected static function booted()
    {
        // Generazione slug in fase di creazione
        static::creating(function ($product) {
            $product->slug = self::generateSlug($product);
        });

        // Rigenerazione slug in fase di update
        static::updating(function ($product) {
            if ($product->isDirty(['brand', 'name', 'unit_size_ml', 'unit_size_g'])) {
                $product->slug = self::generateSlug($product);
            }
        });
    }

    /**
     * Genera lo slug combinando brand, nome e misura
     */
    protected static function generateSlug($product): string
    {
        $parts = [];

        if (!empty($product->brand)) {
            $parts[] = $product->brand;
        }

        $parts[] = $product->name;
        $parts[] = self::sizeToken($product);

        return Str::slug(implode(' ', $parts));
    }

    /**
     * Genera la parte della misura per lo slug
     */
    protected static function sizeToken($product): string
    {
        if ($product->unit_size_ml) {
            $volumeMl = (int) $product->unit_size_ml;
            return $volumeMl % 1000 === 0
                ? ($volumeMl / 1000) . 'l'
                : "{$volumeMl}ml";
        }

        if ($product->unit_size_g) {
            $weightG = (int) $product->unit_size_g;
            return $weightG % 1000 === 0
                ? ($weightG / 1000) . 'kg'
                : "{$weightG}g";
        }

        return '';
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sellables()
    {
        return $this->belongsToMany(Sellable::class)
            ->withPivot("quantity", "unit")
            ->withTimestamps();
    }

    public function batches()
    {
        return $this->hasMany(ProductBatch::class);
    }

    public function getUnitSizeAttribute()
    {
        return $this->unit_size_ml
            ? "{$this->unit_size_ml} ml"
            : "{$this->unit_size_g} g";
    }

    protected $appends = ['unit_size'];
}
