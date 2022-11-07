<?php

namespace App\Http\Controllers;

use App\Place;
use App\PlaceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlaceController extends Controller
{
    public function index(Request $request) {
        $places = Place::all();

        return view('admin.places.index', compact('places'));
    }

    public function create(Request $request) {
        return view('admin.places.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'website' => 'max:255',
            'image' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try {
            $place = $request->all();

            if($request->hasFile('image')) {
                //$place['image'] = $request->image->store('place/image');
                $place['image'] = url('storage/place/image') . '/' .$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('place/image', $request->file('image')->getClientOriginalName());
            }

            Place::create($place);

            return back()->with('flash_success', 'Place Details Saved Successfully');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return back()->with('flash_error', 'Place Not Found');
        }
    }

    public function edit($id) {
        $place = Place::find($id);
        return view('admin.places.edit', compact('place'));
    }

    public function update($id, Request $request) {
        /**
         * @var Place $place
         */
        try {
            $place = Place::find($id);

            if($request->hasFile('image')) {
                $image = url('storage/place/image') . '/' .$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('place/image', $request->file('image')->getClientOriginalName());
            } else {
                $image = $place->image;
            }

            $place->setTypeId($request->input('type_id'))
                ->setName($request->input('name'))
                ->setAddress($request->input('address'))
                ->setLatitude($request->input('latitude'))
                ->setLongitude($request->input('longitude'))
                ->setWebsite($request->input('website', ''))
                ->setImage($image)
                ->save();
            return response()->redirectTo(route('admin.places.index'));
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return back()->with('flash_error', 'Update failed');
        }
    }

    public function delete($id) {
        /**
         * @var Place $place
         */
        try {
            $place = Place::find($id);
            $place->delete();
            return back()->with('flash_success', 'Place is Deleted Successfully');
        } catch(Exception $exception) {
            Log::info($exception->getMessage());
            return back()->with('flash_error', 'Delete failed');
        }
    }

    public function text_search(Request $request) {
        $query = $request->getQueryString();

        $type = $request->input('type');
        if(is_null($type)) {
            $q = $request->input('query');
            $type = str_replace(" Bahamas", "", $q);
        }
        if(isset($type)) {
            $type = str_replace("\"", "", $type);
        }
        Log::info($type);

        $baseAddress = "https://maps.googleapis.com/maps/api/place/textsearch/json?";

        $requestAddress = $baseAddress . $query;

        $response = file_get_contents($requestAddress);

        $manuals = [];

        /**
         * @var PlaceType $place_type
         */
        $place_type = PlaceType::where('google_string', $type)->first();

        if(isset($place_type)) {
            $places = Place::where('type_id', $place_type->id)->get();

            foreach ($places as $place) {
                /**
                 * @var Place $place
                 */
                $manual = [
                    'name' => $place->name,
                    'address' => $place->address,
                    'lat' => $place->latitude,
                    'lng' => $place->longitude,
                ];
                if($place->website != '') {
                    $manual['website'] = $place->website;
                }
                if($place->image != '') {
                    $manual['image'] = asset('storage/' . $place->image);
                }
                $manuals[] = $manual;
            }
        }

        $responseObj = json_decode($response, true);
        $responseObj['manuals'] = $manuals;
        $response = json_encode($responseObj);

        return $response;
    }
}
