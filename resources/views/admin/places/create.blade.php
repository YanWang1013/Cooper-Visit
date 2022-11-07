@extends('admin.layout.base')

@section('title', 'Add Place')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.places.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.places.add_place')</h5>

            <form class="form-horizontal" action="{{ route('admin.places.store') }}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="type_id" class="col-xs-12 col-form-label">Type</label>
                    <div class="col-xs-10">
                        <select name="type_id" id="type_id">
                            @php
                                $types = \App\PlaceType::all();
                            @endphp
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{$type->display_string}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">@lang('admin.name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" required id="name" placeholder="@lang('admin.name')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-xs-12 col-form-label">@lang('admin.address')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="address" value="{{ old('address') }}" required id="address" placeholder="@lang('admin.address')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="latitude" class="col-xs-12 col-form-label">@lang('admin.places.latitude')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" step="0.000000000000001" name="latitude" value="{{ old('latitude') }}" required id="latitude" placeholder="@lang('admin.places.latitude')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="longitude" class="col-xs-12 col-form-label">@lang('admin.places.longitude')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" step="0.000000000000001" name="longitude" value="{{ old('longitude') }}" required id="longitude" placeholder="@lang('admin.places.longitude')">
                    </div>
                </div>

                <div class="box box-block bg-white">
                    <h5 class="mb-1">Location of Place</h5>
                    <h6 class="mb-1">Click to choose location.</h6>
                    <div id="map"></div>
                </div>

                <div class="form-group row">
                    <label for="website" class="col-xs-12 col-form-label">@lang('admin.places.website')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="website" value="{{ old('website') }}" id="website" placeholder="@lang('admin.places.website')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-xs-12 col-form-label">@lang('admin.places.image')</label>
                    <div class="col-xs-10">
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary">@lang('admin.places.add_place')</button>
                        <a href="{{route('admin.places.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style type="text/css">
    #map {
        height: 100%;
        min-height: 500px;
    }

</style>
@endsection

@section('scripts')
<script>
    var map;
    var marker;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 0, lng: 0},
            zoom: 2,
            minZoom: 1,
        });

        map.addListener('click', function(event) {
            let latLng = event.latLng;
            let lat = latLng.lat();
            let lng = latLng.lng();
            $('#latitude').val(lat);
            $('#longitude').val(lng);
        });
    }
</script>
<script src="//maps.googleapis.com/maps/api/js?key={{ Setting::get('map_key') }}&libraries=places&callback=initMap" async defer></script>
@endsection