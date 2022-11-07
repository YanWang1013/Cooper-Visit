<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 't_wallet';

    protected $fillable = [
        'email', 'total', 'amount', 'pp_fee', 'cooper_fee',  'in_out', 'status', 'via', 'via_value', 'purpose', 'nonce', 'currency', 'ride_id', 'paypal_email', 'discount_fee', 'coupon_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    static function getMyBalance($email) {
        $sql = "SELECT SUM(amount) as balance FROM t_wallet WHERE email = '".$email."'";
        $result = DB::select($sql);
        return $result[0]->balance?$result[0]->balance:0;
    }
}
