<?php

namespace SCF\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User's role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has the given role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role) : bool
    {
        return optional($this->role)->name === $role;
    }

    /**
     * Make the user admin role.
     */
    public function makeAdmin()
    {
        $adminRole = Role::find(Role::ADMIN);

        $this->role()->associate($adminRole);
        $this->save();
    }

    /**
     * Toggle verified attribute.
     */
    public function toggleVerified()
    {
        $this->verified = !$this->verified;
    }
}
