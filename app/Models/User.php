<?php

namespace SCF\Models;

use Mail;
use Illuminate\Http\Request;
use SCF\Mail\AccountCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SCF\Mail\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $perPage = 30;

    const CONFIRM_CODE_KEY = 'confirmation_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender'
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
     * User's avatar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(UserAvatar::class);
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
     * Set verified attribute.
     */
    public function verified()
    {
        $this->verified = true;
        $this->save();
    }

    /**
     * Generate confirmation code and send to user.
     *
     * @param Request $request
     */
    public function generateConfirmationCode(Request $request)
    {
        // Generate code
        $codes = [];

        for ($i = 0; $i <= 5; $i++) {
            $codes[$i] = random_int(0, 9);
        }

        $code = implode('', $codes);

        // Store code
        if ($request->session()->exists(self::CONFIRM_CODE_KEY)) {
            $request->session()->remove(self::CONFIRM_CODE_KEY);
        }

        $request->session()->put(self::CONFIRM_CODE_KEY, $code);

        // Send email
        Mail::to($this)->sendNow(new AccountCreated($this, $code));
    }

    /**
     * Get user's avatar url (use gravatar by default)
     *
     * @return String
     */
    public function getAvatarUrlAttribute()
    {
        return optional($this->avatar)->url ?? UserAvatar::defaultUrl();
    }

    /**
     * Get css class for user's role.
     *
     * @return string
     */
    public function roleClass()
    {
        if ($this->role === null) {
            return '';
        }

        if ($this->verified == false) {
            return 'unverified';
        }

        return $this->role->name;
    }

    /**
     * Get user's readable role.
     *
     * @return string
     */
    public function readableRole()
    {
        switch (optional($this->role)->name) {
            case 'admin':
                return 'Administrator';
            case 'coach':
                return 'Coach';
            case 'normal':
                return 'Verified';
        }

        return '';
    }

    /**
     * Send password reset mail.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->sendNow(new ResetPassword($this, $token));
    }
}
