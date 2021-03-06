<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'cnpj',
        'created_at',
        'updated_at',
        'deleted_at',
       'last_login_at',
       'last_login_ip',
        'remember_token',
        'email_verified_at',
        'two_factor_code',
        'two_factor_expires_at',
    ];


    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    // public function setPasswordAttribute($input)
    // {
    //     if ($input) {
    //         $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    //     }
    // }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Generate 6 digits MFA code for the User
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false; //Dont update the 'updated_at' field yet
        
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }
    // public function generateRandomPassword() //envio de senha randomica para o usuario
    // {        
    //     $this->password_token = rand(100000, 999999);
    //     $this->save();
    // }
    function generateRandomPassword($qtyCaraceters = 8)
{
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;

    $specialCharacters = str_shuffle('!@#$%*-');

    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

    $this->password =  Hash::make($password);
    $this->save();
    return $password;
}

    /**
     * Reset the MFA code generated earlier
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false; //Dont update the 'updated_at' field yet
        
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }
}
