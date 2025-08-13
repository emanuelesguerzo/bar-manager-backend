<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $fillable = [
        "user_id",
        "title",
        "content",
        "is_important"
    ];

    protected $casts = [
        "is_important" => "boolean",
    ];

    // User Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
