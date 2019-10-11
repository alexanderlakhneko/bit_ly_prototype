<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['link', 'slug'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function information()
    {
        return $this->hasMany('App\Information');
    }


    /**
     * Return link object by slug column
     * @param  string  $slug
     *
     * @return $this
     */
    public function returnLinkBySlug(string $slug) :Link
    {
        return static::where('slug', $slug)->firstOrFail();
    }
}
