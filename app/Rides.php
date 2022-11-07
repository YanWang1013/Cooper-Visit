<?php

namespace App;

use App\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rides extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 't_rides';
    protected $fillable = [
        'user_id',
        'service_type',
        's_lat',
        's_lon',
        'd_lat',
        'd_lon',
        'ride_msg',
        'request_at',
        'status',
        'driver_id',
        'ride_code',
        'accept_at',
        'arrive_at',
        'book_at',
        'start_at',
        'user_end_at',
        'driver_end_at',
        'payment_method',
        'pay_at',
        'paid_at',
        'user_rated',
        'user_rating',
        'user_rate_at',
        'driver_rated',
        'driver_rating',
        'finish_at',
        'distance',
        'pay_amount',
        'canceled_at',
        'rs_lat',
        'rs_lon',
        'rd_lat',
        'rd_lon',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Users');
    }

    public function driver()
    {
        return $this->belongsTo('App\Drivers');
    }

    public function scopeRequestHistory($query)
    {
        return $query->orderBy('t_rides.id', 'desc')
            ->with('user', 'driver');
    }

    static function getMyUserRating($user_id) {
        $sql = "SELECT AVG(user_rating) as rating FROM t_rides WHERE user_id = ".$user_id;
        $result = DB::select($sql);
        return $result[0]->rating?round($result[0]->rating, 2):0;
    }

    static function getMyDriverRating($driver_id) {
        $sql = "SELECT AVG(driver_rating) as rating FROM t_rides WHERE driver_id = ".$driver_id;
        $result = DB::select($sql);
        return $result[0]->rating?round($result[0]->rating, 2):0;
    }

    static function getDriverFinishedRides($driver_id) {
        $sql = "SELECT COUNT(id) as cnt FROM t_rides WHERE driver_id = ".$driver_id." AND status = ".Constants::$RIDE_STATUS_FINISHED;
        $result = DB::select($sql);
        return $result[0]->cnt;
    }
    static function getDriverCanceledRides($driver_id) {
        $sql = "SELECT COUNT(id) as cnt FROM t_rides WHERE driver_id = ".$driver_id." AND status = ".Constants::$RIDE_STATUS_CANCELED;
        $result = DB::select($sql);
        return $result[0]->cnt;
    }
}
