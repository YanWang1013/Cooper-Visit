<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Wallet;
use Illuminate\Http\Request;

use App\Helpers\Helper;

use Auth;
use Illuminate\Support\Facades\DB;
use Setting;
use Exception;
use \Carbon\Carbon;
use App\Http\Controllers\SendPushNotification;

use App\Users;
use App\Fleet;
use App\Admin;
use App\Drivers;
use App\UserPayment;
use App\ServiceType;
use App\UserRequests;
use App\ProviderService2;
use App\UserRequestRating;
use App\UserRequestPayment;
use App\CustomPush;
use App\Rides;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('demo', ['only' => [
                'settings_store', 
                'settings_payment_store',
                'profile_update',
                'password_update',
                'send_push',
            ]]);
    }


    /**
     * Dashboard.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        try{
            //$rides = UserRequests::has('user')->orderBy('id','desc')->get();
            $rides = Rides::take(10)->orderBy('id','desc')->get();
            $cancel_rides = Rides::where('status', Constants::$RIDE_STATUS_CANCELED)->get();
            $booking_rides_count = Rides::where('status', Constants::$RIDE_STATUS_REQUESTED)
                ->whereNotNull('book_at')
                ->where('book_at', '<>', '0')
                ->orderBy('finish_at', 'desc')
                ->count();
            $user_cancelled_count = $cancel_rides->where('cancel_by','user')->count();
            $driver_cancelled_count = $cancel_rides->where('cancel_by','driver')->count();
            $auto_cancelled_count = $cancel_rides->where('cancel_by','auto')->count();
            $cancel_rides_count = $cancel_rides->count();
            $service = ServiceType::count();
            $revenue = Wallet::sum('cooper_fee');
            $drivers = Drivers::take(10)->orderBy('id','desc')->get();
            $const_ride_status_canceled = Constants::$RIDE_STATUS_CANCELED;
            $total_rides_count = Rides::count();

            return view('admin.dashboard',compact('drivers','booking_rides_count','service','rides','user_cancelled_count','driver_cancelled_count',
                'auto_cancelled_count', 'cancel_rides_count', 'revenue', 'const_ride_status_canceled', 'total_rides_count'));
        }
        catch(Exception $e){
            return redirect()->route('admin.user.index')->with('flash_error','Something Went Wrong with Dashboard!');
        }
    }


    /**
     * Heat Map.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function heatmap()
    {
        try{
            $rides = UserRequests::has('user')->orderBy('id','desc')->get();
            $providers = Drivers::take(10)->orderBy('rating','desc')->get();
            return view('admin.heatmap',compact('providers','rides'));
        }
        catch(Exception $e){
            return redirect()->route('admin.user.index')->with('flash_error','Something Went Wrong with Dashboard!');
        }
    }

    /**
     * Map of all Users and Drivers.
     *
     * @return \Illuminate\Http\Response
     */
    public function map_index()
    {
        return view('admin.map.index');
    }

    /**
     * Map of all Users and Drivers.
     *
     * @return \Illuminate\Http\Response
     */
    public function map_ajax()
    {
        try {

            $Providers = Drivers::where('latitude', '!=', 0)
                    ->where('longitude', '!=', 0)
                    ->with('service')
                    ->get();

            $Users = Users::where('latitude', '!=', 0)
                    ->where('longitude', '!=', 0)
                    ->get();

            for ($i=0; $i < sizeof($Users); $i++) { 
                $Users[$i]->status = 'user';
            }

            $All = $Users->merge($Providers);

            return $All;

        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('admin.settings.application');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function settings_store(Request $request)
    {
        $this->validate($request,[
                'site_title' => 'required',
                'site_icon' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
                'site_logo' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
            ]);

        if($request->hasFile('site_icon')) {
            $site_icon = Helper::upload_picture($request->file('site_icon'));
            Setting::set('site_icon', $site_icon);
        }

        if($request->hasFile('site_logo')) {
            $site_logo = Helper::upload_picture($request->file('site_logo'));
            Setting::set('site_logo', $site_logo);
        }

        if($request->hasFile('site_email_logo')) {
            $site_email_logo = Helper::upload_picture($request->file('site_email_logo'));
            Setting::set('site_email_logo', $site_email_logo);
        }

        Setting::set('site_title', $request->site_title);
        Setting::set('store_link_android', $request->store_link_android);
        Setting::set('store_link_ios', $request->store_link_ios);
        Setting::set('driver_select_timeout', $request->driver_select_timeout);
        Setting::set('driver_search_radius', $request->driver_search_radius);
        Setting::set('sos_number', $request->sos_number);
        Setting::set('contact_number', $request->contact_number);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('site_copyright', $request->site_copyright);
        Setting::set('social_login', $request->social_login);
        Setting::set('map_key', $request->map_key);
        Setting::set('fb_app_version', $request->fb_app_version);
        Setting::set('fb_app_id', $request->fb_app_id);
        Setting::set('fb_app_secret', $request->fb_app_secret);
        Setting::set('manual_request', $request->manual_request == 'on' ? 1 : 0 );
        Setting::set('broadcast_request', $request->broadcast_request == 'on' ? 1 : 0 );
        Setting::set('track_distance', $request->track_distance == 'on' ? 1 : 0 );

        Setting::set('twilio_sid', $request->twilio_sid);
        Setting::set('twilio_token', $request->twilio_token);
        Setting::set('twilio_trial_number', $request->twilio_trial_number);

        Setting::save();
        
        return back()->with('flash_success','Settings Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function settings_payment()
    {
        return view('admin.payment.settings');
    }

    /**
     * Save payment related settings.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function settings_payment_store(Request $request)
    {
        $this->validate($request, [
                'tax_percentage' => 'required|numeric|min:0|max:100',
                'commission_percentage' => 'required|numeric|min:0|max:100',
                'penalty_fee' => 'required|numeric|min:0|max:100',
                'auto_penalty_fee' => 'required|numeric|min:0|max:100',
                'paypal_mode' => 'required|max:20',
                'paypal_client_id' => 'required|max:255',
                'paypal_secret' => 'required|max:255',
                'braintree_env' => 'required|max:20',
                'braintree_merchant_id' => 'required|max:255',
                'braintree_public_key' => 'required|max:255',
                'braintree_private_key' => 'required|max:255'
            ]);

        Setting::set('tax_percentage', $request->tax_percentage );
        Setting::set('commission_percentage', $request->commission_percentage );
        Setting::set('penalty_fee', $request->penalty_fee);
        Setting::set('auto_penalty_fee', $request->auto_penalty_fee);
        Setting::set('paypal_mode', $request->paypal_mode);
        Setting::set('paypal_client_id', $request->paypal_client_id);
        Setting::set('paypal_secret', $request->paypal_secret);
        Setting::set('braintree_env', $request->braintree_env);
        Setting::set('braintree_merchant_id', $request->braintree_merchant_id);
        Setting::set('braintree_public_key', $request->braintree_public_key);
        Setting::set('braintree_private_key', $request->braintree_private_key);
        Setting::save();

        return back()->with('flash_success','Settings Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('admin.account.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile_update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{
            $admin = Auth::guard('admin')->user();
            $admin->name = $request->name;
            $admin->email = $request->email;
            
            if($request->hasFile('avatar')){
                $admin->avatar = $request->avatar->store('admin/profile');
            }
            $admin->save();

            return redirect()->back()->with('flash_success','Profile Updated');
        }
        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('admin.account.change-password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function password_update(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        try {

           $Admin = Admin::find(Auth::guard('admin')->user()->id);

            if(password_verify($request->old_password, $Admin->password))
            {
                $Admin->password = bcrypt($request->password);
                $Admin->save();

                return redirect()->back()->with('flash_success','Password Updated');
            }
        } catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        try {
            //echo "aaaa"; exit;
             $payments = DB::table('t_wallet')->selectRaw('t_wallet.*,concat(t_drivers.first_name," ",t_drivers.last_name) as dname,concat(t_users.first_name," ",t_users.last_name) as uname')->join('t_rides','t_wallet.ride_id','=','t_rides.id','left')
                    ->join('t_users','t_rides.user_id','=','t_users.id','left')
                    ->join('t_drivers','t_rides.driver_id','=','t_drivers.id','left')
                    ->orderBy('t_wallet.created_at','desc')
                    ->get();
            return view('admin.payment.payment-history', compact('payments'));
        } catch (Exception $e) {

             return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        try {
            $str = file_get_contents('http://appoets.com/help.json');
            $Data = json_decode($str, true);
            return view('admin.help', compact('Data'));
        } catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Users Rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_review()
    {
        try {
            $Reviews = UserRequestRating::where('user_id', '!=', 0)->has('user', 'provider')->get();
            return view('admin.review.user_review',compact('Reviews'));
        } catch(Exception $e) {
            return redirect()->route('admin.setting')->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Drivers Rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function provider_review()
    {
        try {
            $Reviews = UserRequestRating::where('provider_id','!=',0)->with('user','provider')->get();
            return view('admin.review.provider_review',compact('Reviews'));
        } catch(Exception $e) {
            return redirect()->route('admin.setting')->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderService2
     * @return \Illuminate\Http\Response
     */
    public function destory_provider_service($id){
        try {
            ProviderService2::find($id)->delete();
            return back()->with('message', 'Service deleted successfully');
        } catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * Testing page for push notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function push_index()
    {

        $data = \PushNotification::app('IOSUser')
            ->to('3911e9870e7c42566b032266916db1f6af3af1d78da0b52ab230e81d38541afa')
            ->send('Hello World, i`m a push message');
        dd($data);
    }

    /**
     * Testing page for push notifications.
     *
     * @return \Illuminate\Http\Response
     */
//    public function push_store(Request $request)
//    {
//        try {
//            ProviderService2::find($id)->delete();
//            return back()->with('message', 'Service deleted successfully');
//        } catch (Exception $e) {
//             return back()->with('flash_error','Something Went Wrong!');
//        }
//    }

    /**
     * privacy.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */

    public function privacy(){
        return view('admin.pages.static')
            ->with('title',"Privacy Page")
            ->with('page', "privacy");
    }

    /**
     * pages.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
//    public function pages(Request $request){
//        $this->validate($request, [
//                'page' => 'required|in:page_privacy',
//                'content' => 'required',
//            ]);
//
//        Setting::set($request->page, $request->content);
//        Setting::save();
//
//        return back()->with('flash_success', 'Content Updated!');
//    }

    /**
     * account statements.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement($type = 'individual'){

        try{
            $page = 'Ride Statement';

            if($type == 'individual'){
                $page = 'Drivers Ride Statement';
            }elseif($type == 'today'){
                $page = 'Today Statement - '. date('d M Y');
            }elseif($type == 'monthly'){
                $page = 'This Month Statement - '. date('F');
            }elseif($type == 'yearly'){
                $page = 'This Year Statement - '. date('Y');
            }

            if ($type == 'today'){
                $rides = Rides::where('created_at', '>=', Carbon::today())->orderBy('created_at','desc')->get();
                $cancel_rides = Rides::where('created_at', '>=', Carbon::today())->where('status',Constants::$RIDE_STATUS_CANCELED)->count();
                $revenue = Wallet::where('created_at', '>=', Carbon::today())->sum('amount');
                $commission = Wallet::where('created_at', '>=', Carbon::today())->sum('cooper_fee');

            } elseif ($type == 'monthly'){
                $rides = Rides::where('created_at', '>=', Carbon::now()->month)->orderBy('created_at','desc')->get();
                $cancel_rides = Rides::where('created_at', '>=', Carbon::now()->month)->where('status',Constants::$RIDE_STATUS_CANCELED)->count();
                $revenue = Wallet::where('created_at', '>=', Carbon::now()->month)->sum('amount');
                $commission = Wallet::where('created_at', '>=', Carbon::now()->month)->sum('cooper_fee');

            } elseif ($type == 'yearly'){
                $rides = Rides::where('created_at', '>=', Carbon::now()->year)->orderBy('created_at','desc')->get();
                $cancel_rides = Rides::where('created_at', '>=', Carbon::now()->year)->where('status',Constants::$RIDE_STATUS_CANCELED)->count();
                $revenue = Wallet::where('created_at', '>=', Carbon::now()->year)->sum('amount');
                $commission = Wallet::where('created_at', '>=', Carbon::now()->year)->sum('cooper_fee');
            } else {
                $rides = Rides::orderBy('created_at','desc')->with('driver')->get();
                $cancel_rides = Rides::where('status',Constants::$RIDE_STATUS_CANCELED)->count();
                $revenue = Wallet::sum('amount');
                $commission = Wallet::sum('cooper_fee');
            }

            return view('admin.drivers.statement', compact('rides','cancel_rides','revenue', 'commission'))
                    ->with('page',$page);

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }


    /**
     * account statements today.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement_today(){
        return $this->statement('today');
    }

    /**
     * account statements monthly.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement_monthly(){
        return $this->statement('monthly');
    }

     /**
     * account statements monthly.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement_yearly(){
        return $this->statement('yearly');
    }


    /**
     * account statements.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement_driver(){

        try{

            $drivers = Drivers::all();

            foreach($drivers as $index => $driver){

                $drivers[$index]->rides_count = Rides::where('driver_id',$driver->id)->count();

                $drivers[$index]->revenue = Wallet::where('email', $driver->email)->sum('amount');
                $drivers[$index]->commission = Wallet::where('email', $driver->email)->sum('cooper_fee');
            }
            return view('admin.drivers.driver_statement', compact('drivers'))->with('page','Drivers Statement');

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function translation(){

        try{
            return view('admin.translation');
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function push(){

        try{
            $Pushes = CustomPush::orderBy('id','desc')->get();
            return view('admin.push',compact('Pushes'));
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }


    /**
     * pages.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function send_push(Request $request){


        $this->validate($request, [
                'send_to' => 'required|in:ALL,USERS,PROVIDERS',
                'user_condition' => ['required_if:send_to,USERS','in:ACTIVE,LOCATION,RIDES,AMOUNT'],
                'provider_condition' => ['required_if:send_to,PROVIDERS','in:ACTIVE,LOCATION,RIDES,AMOUNT'],
                'user_active' => ['required_if:user_condition,ACTIVE','in:HOUR,WEEK,MONTH'],
                'user_rides' => 'required_if:user_condition,RIDES',
                'user_location' => 'required_if:user_condition,LOCATION',
                'user_amount' => 'required_if:user_condition,AMOUNT',
                'provider_active' => ['required_if:provider_condition,ACTIVE','in:HOUR,WEEK,MONTH'],
                'provider_rides' => 'required_if:provider_condition,RIDES',
                'provider_location' => 'required_if:provider_condition,LOCATION',
                'provider_amount' => 'required_if:provider_condition,AMOUNT',
                'message' => 'required|max:100',
            ]);

        try{

            $CustomPush = new CustomPush;
            $CustomPush->send_to = $request->send_to;
            $CustomPush->message = $request->message;

            if($request->send_to == 'USERS'){

                $CustomPush->condition = $request->user_condition;

                if($request->user_condition == 'ACTIVE'){
                    $CustomPush->condition_data = $request->user_active;
                }elseif($request->user_condition == 'LOCATION'){
                    $CustomPush->condition_data = $request->user_location;
                }elseif($request->user_condition == 'RIDES'){
                    $CustomPush->condition_data = $request->user_rides;
                }elseif($request->user_condition == 'AMOUNT'){
                    $CustomPush->condition_data = $request->user_amount;
                }

            }elseif($request->send_to == 'PROVIDERS'){

                $CustomPush->condition = $request->provider_condition;

                if($request->provider_condition == 'ACTIVE'){
                    $CustomPush->condition_data = $request->provider_active;
                }elseif($request->provider_condition == 'LOCATION'){
                    $CustomPush->condition_data = $request->provider_location;
                }elseif($request->provider_condition == 'RIDES'){
                    $CustomPush->condition_data = $request->provider_rides;
                }elseif($request->provider_condition == 'AMOUNT'){
                    $CustomPush->condition_data = $request->provider_amount;
                }
            }

            if($request->has('schedule_date') && $request->has('schedule_time')){
                $CustomPush->schedule_at = date("Y-m-d H:i:s",strtotime("$request->schedule_date $request->schedule_time"));
            }

            $CustomPush->save();

            if($CustomPush->schedule_at == ''){
                $this->SendCustomPush($CustomPush->id);
            }

            return back()->with('flash_success', 'Message Sent to all '.$request->segment);
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }


    public function SendCustomPush($CustomPush){

        try{

            \Log::notice("Starting Custom Push");

            $Push = CustomPush::findOrFail($CustomPush);

            if($Push->send_to == 'USERS'){

                $Users = [];

                if($Push->condition == 'ACTIVE'){

                    if($Push->condition_data == 'HOUR'){

                        $Users = Users::whereHas('trips', function($query) {
                            $query->where('created_at','>=',Carbon::now()->subHour());
                        })->get();
                        
                    }elseif($Push->condition_data == 'WEEK'){

                        $Users = Users::whereHas('trips', function($query){
                            $query->where('created_at','>=',Carbon::now()->subWeek());
                        })->get();

                    }elseif($Push->condition_data == 'MONTH'){

                        $Users = Users::whereHas('trips', function($query){
                            $query->where('created_at','>=',Carbon::now()->subMonth());
                        })->get();

                    }

                }elseif($Push->condition == 'RIDES'){

                    $Users = Users::whereHas('trips', function($query) use ($Push){
                                $query->where('status','COMPLETED');
                                $query->groupBy('id');
                                $query->havingRaw('COUNT(*) >= '.$Push->condition_data);
                            })->get();


                }elseif($Push->condition == 'LOCATION'){

                    $Location = explode(',', $Push->condition_data);

                    $distance = Setting::get('driver_search_radius', '10');
                    $latitude = $Location[0];
                    $longitude = $Location[1];

                    $Users = Users::whereRaw("(1.609344 * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                            ->get();

                }


                foreach ($Users as $key => $user) {
                    (new SendPushNotification)->sendPushToUser($user->id, $Push->message);
                }

            }elseif($Push->send_to == 'PROVIDERS'){


                $Providers = [];

                if($Push->condition == 'ACTIVE'){

                    if($Push->condition_data == 'HOUR'){

                        $Providers = Drivers::whereHas('trips', function($query){
                            $query->where('created_at','>=',Carbon::now()->subHour());
                        })->get();
                        
                    }elseif($Push->condition_data == 'WEEK'){

                        $Providers = Drivers::whereHas('trips', function($query){
                            $query->where('created_at','>=',Carbon::now()->subWeek());
                        })->get();

                    }elseif($Push->condition_data == 'MONTH'){

                        $Providers = Drivers::whereHas('trips', function($query){
                            $query->where('created_at','>=',Carbon::now()->subMonth());
                        })->get();

                    }

                }elseif($Push->condition == 'RIDES'){

                    $Providers = Drivers::whereHas('trips', function($query) use ($Push){
                               $query->where('status','COMPLETED');
                                $query->groupBy('id');
                                $query->havingRaw('COUNT(*) >= '.$Push->condition_data);
                            })->get();

                }elseif($Push->condition == 'LOCATION'){

                    $Location = explode(',', $Push->condition_data);

                    $distance = Setting::get('driver_search_radius', '10');
                    $latitude = $Location[0];
                    $longitude = $Location[1];

                    $Providers = Drivers::whereRaw("(1.609344 * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                            ->get();

                }


                foreach ($Providers as $key => $provider) {
                    (new SendPushNotification)->sendPushToProvider($provider->id, $Push->message);
                }

            }elseif($Push->send_to == 'ALL'){

                $Users = Users::all();
                foreach ($Users as $key => $user) {
                    (new SendPushNotification)->sendPushToUser($user->id, $Push->message);
                }

                $Providers = Drivers::all();
                foreach ($Providers as $key => $provider) {
                    (new SendPushNotification)->sendPushToProvider($provider->id, $Push->message);
                }

            }
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }


}
