<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverDocument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 't_driver_document';

    protected $fillable = [
        'driver_id',
        'document_id',
        'url',
        'unique_id',
        'status',
        'expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The services that belong to the user.
     */
    public function driver()
    {
        return $this->belongsTo('App\Drivers');
    }
    /**
     * The services that belong to the user.
     */
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
}
