<?php

namespace App;

use App\Notifications\ProviderResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Drivers extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * test comment
     * @var array
     */
    protected $table = 't_drivers';
    protected $fillable = [
        'api_token',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'email_verify',
        'sms_verify',
        'gender',
        'birthday',
        'status',
        'social_unique_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The services that belong to the user.
     */
    public function incoming_requests()
    {
        return $this->hasMany('App\RequestFilter')->where('status', 0);
    }

    /**
     * The services that belong to the user.
     */
    public function requests()
    {
        return $this->hasMany('App\RequestFilter');
    }

    /**
     * The services that belong to the user.
     */
    public function profile()
    {
        return $this->hasOne('App\DriverProfile','driver_id', 'id');
    }

    /**
     * The services that belong to the user.
     */
    public function trips()
    {
        return $this->hasMany('App\Rides');
    }
    /**
     * The services that belong to the user.
     */
    public function documents()
    {
        return $this->hasMany('App\DriverDocument', 'driver_id', 'id');
    }

    /**
     * The services that belong to the user.
     */
    public function document($id)
    {
        return $this->hasOne('App\DriverDocument')->where('document_id', $id)->first();
    }

    /**
     * The services that belong to the user.
     */
    public function pending_documents()
    {
        return $this->hasMany('App\DriverDocument', 'driver_id', 'id')->where('status', 'ASSESSING')->count();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ProviderResetPassword($token));
    }
}
