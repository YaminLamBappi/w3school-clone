<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    protected $fillable = [
        "title",
        "description",
        "sequence",
    ];

    public function getRouteKeyName()
    {

        return "slug";
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_slug', 'slug');
    }


    //
}
