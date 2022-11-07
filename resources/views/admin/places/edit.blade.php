@extends('admin.layout.base')

@section('title', 'Edit Place')

@php
    /**
     * @var \App\Place $place
    **/
@endphp

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.places.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Edit Place</h5>

                <form class="form-horizontal" action="{{ route('admin.places.update', $place->id) }}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="type_id" class="col-xs-12 col-form-label">Type</label>
                        <div class="col-xs-10">
                            <select name="type_id" id="type_id">
                                @php
                                    $types = \App\PlaceType::all();
                                @endphp
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ ($place->type_id == $type->id) ? 'selected="selected"' : '' }} >{{$type->display_string}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">@lang('admin.name')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" name="name" value="{{ $place->name }}" required id="name" placeholder="@lang('admin.name')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-xs-12 col-form-label">@lang('admin.address')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" name="address" value="{{ $place->address }}" required id="address" placeholder="@lang('admin.address')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="latitude" class="col-xs-12 col-form-label">@lang('admin.places.latitude')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" step="0.000000000000001" name="latitude" value="{{ $place->latitude }}" required id="latitude" placeholder="@lang('admin.places.latitude')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="longitude" class="col-xs-12 col-form-label">@lang('admin.places.longitude')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" step="0.000000000000001" name="longitude" value="{{ $place->longitude }}" required id="longitude" placeholder="@lang('admin.places.longitude')">
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
                            <input class="form-control" type="text" name="website" value="{{ $place->website }}" id="website" placeholder="@lang('admin.places.website')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-xs-12 col-form-label">@lang('admin.places.image')</label>
                        <div class="col-xs-10">
                            @if(isset($place->image))
                                <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ $place->image }}">
                            @endif
                            <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Save changes</button>
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

        function initMap() {
            //console.log('iinitmap');
            var myLatlng = new google.maps.LatLng( {{$place->latitude}}, {{$place->longitude}} );
            var myOptions = {
                zoom: 15,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map"), myOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                draggable:true
            });
            google.maps.event.addListener(
                marker,
                'drag',
                function() {
                    $('#latitude').val(marker.position.lat());
                    $('#longitude').val(marker.position.lng());
                }
            );

            $( '#latitude, #longitude' ).focusout( function() {
                var latitude = parseFloat( document.getElementById('latitude').value );
                var longitude = parseFloat( document.getElementById('longitude').value );

                if( !isNaN( latitude ) && !isNaN( longitude ) ) {
                    map.panTo( {
                        lat: latitude,
                        lng: longitude
                    });
                    marker.setPosition({
                        lat: latitude,
                        lng: longitude
                    });
                }
            });
        }
    </script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ Setting::get('map_key') }}&libraries=places&callback=initMap" async defer></script>
@endsection