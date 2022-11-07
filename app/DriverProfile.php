<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 't_driver_profile';
    protected $fillable = [
        'driver_id',
        'avatar',
        'language',
        'address',
        'address_2',
        'city',
        'country',
        'postal_code',
        'car_number',
        'car_model',
        'status',
        'service_type',
        'service_type_status',
        'new_service_type',
        'service_type_new_at',
        'service_type_approve_at',
        'service_type_release_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    /**
     * The services that belong to the user.
     */
    public function driver()
    {
        return $this->belongsTo('App\Drivers');
    }

    public function service_type_info()
    {
        return $this->belongsTo('App\ServiceType', 'service_type');
    }

    public function new_service_type_info()
    {
        return $this->belongsTo('App\ServiceType', 'new_service_type');
    }
}
