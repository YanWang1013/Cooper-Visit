<?php

namespace App\Http\Controllers\Resource;

use App\Coupons;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class CouponResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupons::orderBy('created_at' , 'desc')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'coupon_code' => 'required|max:100|unique:t_coupons',
            'discount' => 'required|numeric',
            'expiration' => 'required',
            'discount_type' => 'required',
        ]);

        try{

            Coupons::create($request->all());
            return back()->with('flash_success','Coupons Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coupons Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupons  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Coupons::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupons  $promocode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $coupon = Coupons::findOrFail($id);
            return view('admin.coupon.edit',compact('coupon'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupons  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'coupon_code' => 'required|max:100',
            'discount' => 'required|numeric',
            'expiration' => 'required',
            'discount_type' => 'required',
        ]);

        try {

            $coupon = Coupons::findOrFail($id);

            $coupon->coupon_code = $request->coupon_code;
            $coupon->discount = $request->discount;
            $coupon->discount_type = $request->discount_type;
            $coupon->expiration = $request->expiration;
            $coupon->save();

            return redirect()->route('admin.coupon.index')->with('flash_success', 'Coupons Updated Successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coupons Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupons  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Coupons::find($id)->delete();
            return back()->with('message', 'Coupons deleted successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coupons Not Found');
        }
    }
}
