<?php


namespace App;



class Constants
{
    static public $USER_STATUS_INIT = 0;
    static public $USER_STATUS_VERIFIED = 1;
    static public $USER_STATUS_ACTIVED = 2;
    static public $USER_STATUS_TRAVELED = 3;

    static public $DRIVER_STATUS_INIT = 0;
    static public $DRIVER_STATUS_VERIFIED = 1;
    static public $DRIVER_STATUS_ACTIVED = 2;
    static public $DRIVER_STATUS_TRAVELED = 3;
    static public $DRIVER_STATUS_DENIED = 4;

    static public $RIDE_STATUS_REQUESTED = 0;
    static public $RIDE_STATUS_CANCELED = 1;
    static public $RIDE_STATUS_ACCEPTED = 2;
    static public $RIDE_STATUS_ARRIVED = 3;
    static public $RIDE_STATUS_STARTED = 4;
    static public $RIDE_STATUS_USERENDED = 5;
    static public $RIDE_STATUS_DRIVERENDED = 6;
    static public $RIDE_STATUS_PAY = 7;
    static public $RIDE_STATUS_PAID = 8;
    static public $RIDE_STATUS_USERRATED = 9;
    static public $RIDE_STATUS_FINISHED = 10;

    static public $COUPON_STATUS_CREATED = 'CREATED';
    static public $COUPON_STATUS_ADDED = 'ADDED';
    static public $COUPON_STATUS_EXPIRED = 'EXPIRED';
    static public $COUPON_STATUS_USED = 'USED';

    static public $SERVICETYPE_STATUS_INIT = 0;
    static public $SERVICETYPE_STATUS_APPROVE = 1;
    static public $SERVICETYPE_STATUS_RELEASE = 2;

}
