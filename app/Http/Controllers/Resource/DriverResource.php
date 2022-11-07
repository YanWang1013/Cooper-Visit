<?php

namespace App\Http\Controllers\Resource;

use App\Constants;
use App\DriverProfile;
use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Exception;
use Setting;
use Storage;

use App\Drivers;
use App\UserRequestPayment;
use App\Rides;
use App\Helpers\Helper;

class DriverResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('demo', ['only' => [ 'store', 'update', 'destroy', 'disapprove']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $AllDrivers = Drivers::orderBy('id', 'asc');

        if(request()->has('fleet')){
            $drivers = $AllDrivers->where('fleet',$request->fleet)->get();
        }else{
            $drivers = $AllDrivers->get();
        }
        foreach ($drivers as $d) {
            $d['finished_rides'] = Rides::getDriverFinishedRides($d->id);
            $d['canceled_rides'] = Rides::getDriverCanceledRides($d->id);
            $d['total_rides'] = $d['finished_rides'] + $d['canceled_rides'];
        }
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:drivers,email|email|max:255',
            'mobile' => 'digits_between:6,13',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
            'password' => 'required|min:6|confirmed',
        ]);

        try{

            $provider = $request->only('first_name','last_name','password');
            $provider['password'] = bcrypt($request->password);
            $provider['phone_number'] = $request->mobile;
            $provider = Drivers::create($provider);
            $detail = $request->only('mobile');
            if($request->hasFile('avatar')) {
                $detail['avatar'] = $request->avatar->store('provider/profile');
            }
            $detail['driver_id'] = $provider->id;
            DriverProfile::create($detail);
            return back()->with('flash_success','Drivers Details Saved Successfully');

        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Drivers Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $provider = Drivers::findOrFail($id);
            return view('admin.drivers.provider-details', compact('provider'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $provider = Drivers::with('profile')->findOrFail($id);
            return view('admin.drivers.edit',compact('provider'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try {

            $provider = Drivers::findOrFail($id);
            $detail = DriverProfile::where('driver_id',$id)->first();
            if($request->hasFile('avatar')) {
                if($provider->avatar) {
                    Storage::delete($provider->avatar);
                }
                $detail->avatar = $request->avatar->store('provider/profile');
            }

            $provider->first_name = $request->first_name;
            $provider->last_name = $request->last_name;
            $provider->phone_number = $request->mobile;
            $provider->save();
            $detail->save();
            return redirect()->route('admin.driver.index')->with('flash_success', 'Drivers Updated Successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Drivers Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            Drivers::find($id)->delete();
            return back()->with('message', 'Drivers deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Drivers Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        try {
            $Provider = Drivers::findOrFail($id);
            if($Provider->service) {
                $Provider->update(['status' => 'approved']);
                return back()->with('flash_success', "Drivers Approved");
            } else {
                return redirect()->route('admin.driver.document.index', $id)->with('flash_error', "Drivers has not been assigned a service type!");
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', "Something went wrong! Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function disapprove($id)
    {
        
        Drivers::where('id',$id)->update(['status' => 'banned']);
        return back()->with('flash_success', "Drivers Disapproved");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function ride($id){

        try{

            $rides = Rides::where('driver_id',$id)->get();

            return view('admin.rides.index', compact('rides'));
        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * account statements.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement($id){

        try{

            $driver =  Drivers::findOrFail($id);
            $rides = Rides::where('driver_id',$id)->orderBy('id','desc')->paginate(10);
            $cancel_rides = Rides::where('status',Constants::$RIDE_STATUS_CANCELED)->where('driver_id',$id)->count();
            $revenue = Wallet::where('email', $driver->email)->sum('amount');
            $commission = Wallet::where('email', $driver->email)->sum('cooper_fee');


            $Joined = $driver->created_at ? '- Joined '.$driver->created_at->diffForHumans() : '';

            return view('admin.drivers.statement', compact('rides','cancel_rides','revenue', 'commission'))
                        ->with('page',$driver->first_name."'s Overall Statement ". $Joined);

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }

    public function Accountstatement($id){

        try{

            $requests = UserRequests::where('provider_id',$id)
                        ->where('status','COMPLETED')
                        ->with('payment')
                        ->get();

            $rides = UserRequests::where('provider_id',$id)->with('payment')->orderBy('id','desc')->paginate(10);
            $cancel_rides = UserRequests::where('status','CANCELLED')->where('provider_id',$id)->count();
            $Provider = Drivers::find($id);
            $revenue = UserRequestPayment::whereHas('request', function($query) use($id) {
                                    $query->where('provider_id', $id );
                                })->select(\DB::raw(
                                   'SUM(ROUND(fixed) + ROUND(distance)) as overall, SUM(ROUND(commision)) as commission' 
                               ))->get();


            $Joined = $Provider->created_at ? '- Joined '.$Provider->created_at->diffForHumans() : '';

            return view('account.drivers.statement', compact('rides','cancel_rides','revenue'))
                        ->with('page',$Provider->first_name."'s Overall Statement ". $Joined);

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }

    public function paymentHistory($id) {
        try {
            //echo "aaaa"; exit;
            $payments = \Illuminate\Support\Facades\DB::table('t_wallet')->where('t_rides.driver_id',$id)->selectRaw('t_wallet.*,concat(t_drivers.first_name," ",t_drivers.last_name) as dname,concat(t_users.first_name," ",t_users.last_name) as uname')->join('t_rides','t_wallet.ride_id','=','t_rides.id','left')
                ->join('t_users','t_rides.user_id','=','t_users.id','left')
                ->join('t_drivers','t_rides.driver_id','=','t_drivers.id','left')
                ->orderBy('t_wallet.created_at','desc')
                ->get();
            return view('admin.payment.payment-history', compact('payments'));
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
            return back()->with('flash_error','Something Went Wrong!');
        }
    }
}
