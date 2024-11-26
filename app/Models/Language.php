<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getRouteKeyName()
    {

        return "slug";
    }

    public function topic()
    {
        return $this->hasMany(Topic::class, 'language_slug', 'slug');
    }
    //
}
