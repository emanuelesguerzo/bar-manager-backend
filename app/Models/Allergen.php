<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{

    protected $fillable = [
        "name",
        "slug",
        "description",
    ];

    protected $hidden = [
        "pivot",
        "created_at",
        "updated_at",
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sellables()
    {
        return $this->belongsToMany(Sellable::class);
    }
    
}
