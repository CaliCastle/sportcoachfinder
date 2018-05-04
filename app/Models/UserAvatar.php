<?php

namespace SCF\Models;

use Storage;
use Illuminate\Http\UploadedFile;
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

    const FOLDER = 'public/';

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
     * Store the avatar file to storage and database.
     *
     * @param UploadedFile $file
     * @param User         $user
     */
    public static function store(UploadedFile $file, User $user)
    {
        // Configure file name, {user_id}-{time}.{ext}
        $fileName = $user->id . '-' . md5(time()) . '.' . $file->clientExtension();
        $file->storePubliclyAs(self::FOLDER . self::PATH, $fileName);

        // Persist into database
        $attributes = [
            'src'  => $fileName,
            'type' => self::LOCAL
        ];

        // Create or update
        if ($user->avatar instanceof self) {
            $user->avatar->moveToTrash();
            // Update to the new one
            $user->avatar()->update($attributes);
        } else {
            $user->avatar()->create($attributes);
        }
    }

    /**
     * Remove the avatar file from storage.
     */
    public function moveToTrash()
    {
        // Delete old avatar
        Storage::delete(self::FOLDER . self::PATH . '/' . $this->src);
    }

    /**
     * Get url attribute.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        if ($this->type == static::LOCAL) {
            // Local avatar
            return isset($this->src) ? Storage::url(self::PATH . '/' . $this->src) : null;
        } else {
            // Remote avatar
            return $this->src;
        }
    }

}
