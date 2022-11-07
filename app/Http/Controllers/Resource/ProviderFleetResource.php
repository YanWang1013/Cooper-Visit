<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Exception;
use Auth;

use App\Drivers;
use App\UserRequests;
use App\Helpers\Helper;

class ProviderFleetResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Drivers::with('service','accepted','cancelled')
                    ->where('fleet', Auth::user()->id )
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('fleet.drivers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fleet.drivers.create');
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

            $provider = $request->all();

            $provider['password'] = bcrypt($request->password);
            $provider['fleet'] = Auth::user()->id;
            if($request->hasFile('avatar')) {
                $provider['avatar'] = $request->avatar->store('provider/profile');
            }

            $provider = Drivers::create($provider);

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
            return view('fleet.drivers.provider-details', compact('provider'));
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
            $provider = Drivers::findOrFail($id);
            return view('fleet.drivers.edit',compact('provider'));
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

            if($request->hasFile('avatar')) {
                if($provider->avatar) {
                    Storage::delete($provider->avatar);
                }
                $provider->avatar = $request->avatar->store('provider/profile');                    
            }

            $provider->first_name = $request->first_name;
            $provider->last_name = $request->last_name;
            $provider->mobile = $request->mobile;
            $provider->save();

            return redirect()->route('fleet.provider.index')->with('flash_success', 'Drivers Updated Successfully');
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
                return redirect()->route('fleet.provider.document.index', $id)->with('flash_error', "Drivers has not been assigned a service type!");
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
    public function request($id){

        try{

            $requests = UserRequests::where('user_requests.provider_id',$id)
                    ->RequestHistory()
                    ->get();

            return view('fleet.request.index', compact('requests'));
        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }
}
