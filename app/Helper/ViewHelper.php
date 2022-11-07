<?php

use App\PromocodeUsage;
use App\ServiceType;
use App\Wallet;

function currency($value = '')
{
	if($value == ""){
		return Setting::get('currency')."0.00";
	} else {
		return Setting::get('currency').$value;
	}
}

function distance($value = '')
{
    if($value == ""){
        return "0".Setting::get('distance', 'Km');
    }else{
        return $value.Setting::get('distance', 'Km');
    }
}

function img($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
		return asset('storage/'.$img);
	}
}

function image($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else{
		return asset($img);
	}
}

function promo_used_count($promo_id)
{
	return PromocodeUsage::where('status','ADDED')->where('promocode_id',$promo_id)->count();
}

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
}

function get_all_service_types()
{
	return ServiceType::all();
}

function demo_mode(){
	if(\Setting::get('demo_mode', 0) == 1) {
        return back()->with('flash_error', 'Disabled for demo purposes! Please contact us at info@1magine.ca');
    }
}

function ride_status_msg($status) {

    if ($status == \App\Constants::$RIDE_STATUS_REQUESTED) {
        return 'Requested';
    } else if ($status == \App\Constants::$RIDE_STATUS_CANCELED) {
        return 'Cancelled';
    } else if ($status == \App\Constants::$RIDE_STATUS_ACCEPTED) {
        return 'Accepted';
    } else if ($status == \App\Constants::$RIDE_STATUS_ARRIVED) {
        return 'Picked Up';
    } else if ($status == \App\Constants::$RIDE_STATUS_STARTED) {
        return 'Started';
    } else if ($status == \App\Constants::$RIDE_STATUS_DRIVERENDED) {
        return 'Arrived at Destination';
    } else if ($status == \App\Constants::$RIDE_STATUS_FINISHED) {
        return 'Finished';
    } else if ($status == \App\Constants::$RIDE_STATUS_PAY) {
        return 'Paid';
    } else if ($status == \App\Constants::$RIDE_STATUS_USERRATED) {
        return 'Rated By User';
    } else {
        return 'Going';
    }

}

function ride_earning($ride_id, $driver_email) {
    if (!empty($driver_email)) {
        $wallet = Wallet::where(array('ride_id'=>$ride_id, 'email'=>$driver_email))->first();
        $earning = $wallet?$wallet->amount:0;
    } else {
        $earning = 0;
    }
    return $earning;
}

function driver_status_msg($status) {

    if ($status == \App\Constants::$DRIVER_STATUS_INIT) {
        return 'New Driver';
    } else if ($status == \App\Constants::$DRIVER_STATUS_VERIFIED) {
        return 'Verified';
    } else if ($status == \App\Constants::$DRIVER_STATUS_ACTIVED) {
        return 'Actived';
    } else if ($status == \App\Constants::$DRIVER_STATUS_TRAVELED) {
        return 'Travelling';
    } else {
        return 'Denied';
    }

}