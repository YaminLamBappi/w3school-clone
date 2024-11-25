<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        "title",
        "description",
        "sequence",
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    //
}
