<?php

namespace SCF\Models;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = ['src', 'type'];

    /**
     * The local type lookup.
     */
    const LOCAL = 0;

    /**
     * The remote type lookup.
     */
    const REMOTE = 1;

    /**
     * The path for avatars.
     */
    const PATH = 'avatars';

    /**
     * Belongs to whom.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get default avatar url.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public static function defaultUrl()
    {
        return url('assets/images/default-avatar.png');
    }

    /**
     * Get url attribute.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        return isset($this->src) ? url('avatars/' . $this->src) : null;
    }
}
