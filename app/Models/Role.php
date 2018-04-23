<?php

namespace SCF\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Fillable fields.
    protected $fillable = ['name'];

    // No timestamps.
    public $timestamps = false;

    public const NORMAL = 1;
    public const COACH = 2;
    public const ADMIN = 3;

    /**
     * Generate default roles.
     */
    public static function generateDefault()
    {
        static::create([
            'name' => 'normal'
        ]);
        static::create([
            'name' => 'coach'
        ]);
        static::create([
            'name' => 'admin'
        ]);
    }
}
