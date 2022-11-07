<?php

namespace App\Http\Controllers\Resource;

use App\Http\Utils;
use App\Rides;
use App\Users;
use App\UserRequests;
use App\Wallet;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Storage;
use Setting;

class UserResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('demo', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::orderBy('id' , 'asc')->get();
        foreach ($users as $u) {
            $u['balance'] = Wallet::getMyBalance($u->email);
            $u['rating'] = Rides::getMyUserRating($u->id);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required|unique:users,email|email|max:255',
            'phone_number' => 'digits_between:6,13',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
            'password' => 'required|min:6|confirmed',
            'gender'=>'max:1',
            'birthday'=>'max:10',
        ]);

        try{

            $user = $request->all();
            $user['password'] = bcrypt($request->password);
            if($request->hasFile('avatar')) {
                $user['avatar'] = $request->avatar->store('user/profile');
            }
            $sms_verify_code=Str::random(7);
            $email_verify_code=Str::random(7);
            do {
                $api_token=Str::random(20);
            } while (Users::where('api_token', $api_token)->first());

            $user['sms_otp']=$sms_verify_code;
            $user['email_otp']=$email_verify_code;
            $user['api_token']=$api_token;
            //print_r($user); exit;
            Utils::sendSmsForVerify($request->phone_number, $sms_verify_code);
            Users::create($user);

            return back()->with('flash_success','Users Details Saved Successfully');

        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Users Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = Users::findOrFail($id);
            return view('admin.users.user-details', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = Users::findOrFail($id);
            return view('admin.users.edit',compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try {

            $user = Users::findOrFail($id);

            if($request->hasFile('picture')) {
                Storage::delete($user->picture);
                $user->avatar = $request->picture->store('user/profile');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->mobile;
            $user->save();

            return redirect()->route('admin.user.index')->with('flash_success', 'Users Updated Successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Users Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {

            Users::find($id)->delete();
            return back()->with('message', 'Users deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Users Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drivers  $provider
     * @return \Illuminate\Http\Response
     */
    public function request($id){

        try{
            $rides = Rides::where('user_id',$id)->get();

            return view('admin.rides.index', compact('rides'));
            /*$requests = UserRequests::where('user_requests.user_id',$id)
                    ->RequestHistory()
                    ->get();

            return view('admin.rides.index', compact('requests'));*/
        }

        catch (Exception $e) {
            echo $e->getMessage();
            die;
             return back()->with('flash_error','Something Went Wrong!');
        }

    }

    public function paymentHistory($id) {
        try {
            //echo "aaaa"; exit;
            $payments = DB::table('t_wallet')->where('t_rides.user_id',$id)->selectRaw('t_wallet.*,concat(t_drivers.first_name," ",t_drivers.last_name) as dname,concat(t_users.first_name," ",t_users.last_name) as uname')->join('t_rides','t_wallet.ride_id','=','t_rides.id','left')
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
