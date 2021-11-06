<?php

namespace App;

use App\Notifications\PasswordReset;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_name', 'company_logo', 'company_license', 'email', 'country', 'github_id', 'google_id', 'facebook_id', 'linkedin_id', 'password', 'phone_number', 'sign_date', 'block', 'verified', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop()
    {
        return $this->hasOne('App\Shop')->withDefault();
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role_name)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $role_name) {
                return true;
            }
        }

        return false;
    }

    public function addNew($input)
    {

        $check = static::where('facebook_id', $input['facebook_id'])->first();

        if (is_null($check)) {

            return static::create($input);

        }

        return $check;

    }

    public function getBlockstatus($id)
    {
        if (@$id) {
            if ($id == 0) { //normal status
                $result = "Normal";
            } else if ($id == 1) { //user blocked status
                $result = "Blocked";
            }
        } else {
            $result = "Normal";
        }

        return $result;
    }

    /**
     * get user verified status information
     * @param user verified value
     * @since 2020-12-14
     * @return boolean result 1 or 2
     * @author Nemanja
     */
    public function getVerifiedstatus($verified)
    {
        if (@$verified) {
            if ($verified == 1) {
                $result = "Not Verified.";
            }if ($verified == 2) {
                $result = "Verified.";
            }
        } else {
            $result = "None";
        }

        return $result;
    }

    /**
     * get user verified status information
     * @param product userid value
     * @since 2020-12-14
     * @return boolean result 1 or 2
     * @author Nemanja
     */
    public static function getVerifystatusByproduct($verified)
    {
        if (@$verified) {
            $rec = User::where('id', $verified)->first();
            if (@$rec) {
                $result = $rec->verified;
            } else {
                $result = "-1";
            }
        } else {
            $result = "-1";
        }

        return $result;
    }

    public static function getMarks($id)
    {
        if (@$id) {
            $marks = DB::table('reviews')
                ->where('receiver', $id)
                ->avg('mark');

            return $marks;
        }
    }

    public function getUsername($id)
    {
        if (@$id) {
            $user = User::where('id', $id)->first();
            $name = $user->name;
        }

        return $name;
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}