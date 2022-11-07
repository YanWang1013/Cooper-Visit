<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 't_users';

    protected $fillable = [
        'api_token', 'first_name', 'last_name', 'gender', 'email', 'phone_number', 'avatar', 'password', 'device_type','device_token','login_by',
        'sms_otp', 'sms_verify', 'email_otp', 'email_verify', 'social_unique_id','device_id', 'reset_otp', 'birthday', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at'
    ];


    /**
     * The services that belong to the user.
     */
    public function trips()
    {
        return $this->hasMany('App\UserRequests','user_id','id');
    }

}
