<?php

namespace App\Http\Controllers\Resource;

use App\Constants;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendPushNotification;

use DB;
use Exception;
use Setting;

use App\Drivers;
use App\ServiceType;
use App\DriverProfile;
use App\DriverDocument;
use App\Helpers\Helper;

class DriverDocumentResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $driver_id)
    {
        try {
            $driver = Drivers::where('id', $driver_id)->first();
            $profile = DriverProfile::where('driver_id', $driver_id)->with('service_type_info')->get();
            $new_service_type = ServiceType::where('id', $profile[0]->new_service_type)->first();
            $ServiceTypes = ServiceType::all();
            return view('admin.drivers.document.index', compact('driver', 'ServiceTypes', 'profile', 'new_service_type'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $driver)
    {
        $this->validate($request, [
                'service_type' => 'required|exists:service_types,id',
                'service_number' => 'required',
                'service_model' => 'required',
            ]);
        

        try {
            
            $ProviderService = ProviderService2::where('driver_id', $driver)->firstOrFail();
            $ProviderService->update([
                    'service_type_id' => $request->service_type,
                    'status' => 'offline',
                    'service_number' => $request->service_number,
                    'service_model' => $request->service_model,
                ]);

            // Sending push to the driver
            (new SendPushNotification)->DocumentsVerfied($driver);

        } catch (ModelNotFoundException $e) {
            ProviderService2::create([
                    'driver_id' => $driver,
                    'service_type_id' => $request->service_type,
                    'status' => 'offline',
                    'service_number' => $request->service_number,
                    'service_model' => $request->service_model,
                ]);
        }

        return redirect()->route('admin.driver.document.index', $driver)->with('flash_success', 'Drivers service type updated successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($driver, $id)
    {
        try {
            $Document = DriverDocument::where('driver_id', $driver)
                ->findOrFail($id);

            return view('admin.drivers.document.edit', compact('Document'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driver, $id)
    {
        try {
            $Document = DriverDocument::where('driver_id', $driver)
                ->findOrFail($id);
            $Document->update(['status' => 'ACTIVE']);

            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_success', 'Drivers document has been approved.');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_error', 'Drivers not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver, $id)
    {
        try {

            $Document = DriverDocument::where('driver_id', $driver)
                ->where('document_id', $id)
                ->firstOrFail();
            $Document->delete();

            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_success', 'Drivers document has been deleted');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_error', 'Drivers not found!');
        }
    }

    /**
     * Delete the service type of the driver.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service_destroy(Request $request, $driver, $id)
    {
        try {

            $ProviderService = ProviderService2::where('driver_id', $driver)->firstOrFail();
            $ProviderService->delete();

            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_success', 'Drivers service has been deleted.');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_error', 'Drivers service not found!');
        }
    }

    public function service_approve(Request $request, $driver)
    {
        try {

            $profile = DriverProfile::where('driver_id', $driver)->firstOrFail();
            $data = array();
            $data['service_type_status'] = Constants::$SERVICETYPE_STATUS_APPROVE;
            $data['service_type_approve_at'] = date('Y-m-d H:i:s');
            $profile->update($data);

            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_success', 'The vehicle category has been approved.');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.driver.document.index', $driver)
                ->with('flash_error', 'The vehicle category not found!');
        }
    }
}
