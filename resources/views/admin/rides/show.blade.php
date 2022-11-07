@extends('admin.layout.base')

@section('title', 'Request details ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h4>Ride details</h4>
            <hr>
            <a href="{{ route('admin.rides.index') }}" class="btn btn-default pull-right">
                <i class="fa fa-angle-left"></i> Back
            </a>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">User Name :</dt>
                        <dd class="col-sm-8">{{ $ride->user->first_name }} {{ $ride->user->last_name }}</dd>

                        <dt class="col-sm-4">Driver Name :</dt>
                        @if($ride->driver)
                        <dd class="col-sm-8">{{ $ride->driver->first_name }} {{ $ride->driver->last_name }}</dd>
                        @else
                        <dd class="col-sm-8">Driver not yet assigned!</dd>
                        @endif

                        <dt class="col-sm-4">Pick Up Address :</dt>
                        <dd class="col-sm-8">{{ $ride->s_address}}</dd>

                        <dt class="col-sm-4">Destination Address :</dt>
                        <dd class="col-sm-8">{{ $ride->d_address}}</dd>

                        <dt class="col-sm-4">Estimated Distance :</dt>
                        <dd class="col-sm-8">{{ $ride->eta_distance ? round($ride->eta_distance/1000, 2).' Km' : '-' }}</dd>

                        <dt class="col-sm-4">@lang('admin.rides.distance') :</dt>
                        <dd class="col-sm-8">{{ $ride->distance ? round($ride->distance/1000, 2).' Km' : '-' }}</dd>

                        @if(!empty($ride->book_at))
                        <dt class="col-sm-4">Ride Scheduled Time :</dt>
                        <dd class="col-sm-8">
                            @if(!empty($ride->book_at) && $ride->book_at != "0000-00-00 00:00:00")
                                {{ date('jS \of F Y h:i:s A', strtotime($ride->book_at)) }}
                            @else
                                - 
                            @endif
                        </dd>
                        @else
                        <dt class="col-sm-4">Ride Start Time :</dt>
                        <dd class="col-sm-8">
                            @if(!empty($ride->start_at) && $ride->start_at != "0000-00-00 00:00:00")
                                {{ date('jS \of F Y h:i:s A', strtotime($ride->start_at)) }}
                            @else
                                - 
                            @endif
                         </dd>

                        <dt class="col-sm-4">Ride End Time :</dt>
                        <dd class="col-sm-8">
                            @if(!empty($ride->finish_at) && $ride->finish_at != "0000-00-00 00:00:00")
                                {{ date('jS \of F Y h:i:s A', strtotime($ride->finish_at)) }}
                            @else
                                - 
                            @endif
                        </dd>
                        @endif

{{--                        <dt class="col-sm-4">Pickup Address :</dt>--}}
{{--                        <dd class="col-sm-8">{{ $ride->s_address ? $ride->s_address : '-' }}</dd>--}}

{{--                        <dt class="col-sm-4">Drop Address :</dt>--}}
{{--                        <dd class="col-sm-8">{{ $ride->d_address ? $ride->d_address : '-' }}</dd>--}}

                        <dt class="col-sm-4">Payment Method :</dt>
                        <dd class="col-sm-8">{{ $ride->payment_method }}</dd>

                        @if($ride->pay_amount)
                        <dt class="col-sm-4">Base Price :</dt>
                        <dd class="col-sm-8">{{ currency($ride->base_fee) }}</dd>

                        <dt class="col-sm-4">Distance Price :</dt>
                        <dd class="col-sm-8">{{ currency($ride->distance_fee) }}</dd>

                        <dt class="col-sm-4">Service Charges :</dt>
                        <dd class="col-sm-8">{{ currency($ride->cooper_fee) }}</dd>

                        <dt class="col-sm-4">Discount Price :</dt>
                        <dd class="col-sm-8">{{ currency($ride->discount_fee) }}</dd>

                        <dt class="col-sm-4">Tax Price :</dt>
                        <dd class="col-sm-8">{{ currency($ride->tax_fee) }}</dd>

{{--                        <dt class="col-sm-4">Surge Price :</dt>--}}
{{--                        <dd class="col-sm-8">{{ currency($ride->payment->surge) }}</dd>--}}

                        <dt class="col-sm-4">Total Amount :</dt>
                        <dd class="col-sm-8">{{ currency($ride->pay_amount) }}</dd>

{{--                        <dt class="col-sm-4">Wallet Deduction :</dt>--}}
{{--                        <dd class="col-sm-8">{{ currency($ride->payment->wallet) }}</dd>--}}

{{--                        <dt class="col-sm-4">Paid Amount :</dt>--}}
{{--                        <dd class="col-sm-8">{{ currency($ride->payment->payable) }}</dd>--}}

{{--                        <dt class="col-sm-4">Provider Earnings:</dt>--}}
{{--                        <dd class="col-sm-8">{{ currency($ride->payment->provider_pay) }}</dd>--}}

{{--                        <dt class="col-sm-4">Provider Admin Commission :</dt>--}}
{{--                        <dd class="col-sm-8">{{ currency($ride->payment->provider_commission) }}</dd>--}}
                        @endif

                        <dt class="col-sm-4">Ride Status : </dt>
                        <dd class="col-sm-8">
                            {{ ride_status_msg($ride->status) }}
                        </dd>

                    </dl>
                </div>
{{--                <div class="col-md-6">--}}
{{--                    <div id="map"></div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    #map {
        height: 450px;
    }
</style>
@endsection

@section('scripts')
<script type="text/javascript">
    var map;
    var zoomLevel = 11;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'));

        var marker = new google.maps.Marker({
            map: map,
            icon: '/asset/img/marker-start.png',
            anchorPoint: new google.maps.Point(0, -29)
        });

         var markerSecond = new google.maps.Marker({
            map: map,
            icon: '/asset/img/marker-end.png',
            anchorPoint: new google.maps.Point(0, -29)
        });

        var bounds = new google.maps.LatLngBounds();

        source = new google.maps.LatLng({{ $ride->s_latitude }}, {{ $ride->s_longitude }});
        destination = new google.maps.LatLng({{ $ride->d_latitude }}, {{ $ride->d_longitude }});

        marker.setPosition(source);
        markerSecond.setPosition(destination);

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true, preserveViewport: true});
        directionsDisplay.setMap(map);

        directionsService.route({
            origin: source,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        }, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                console.log(result);
                directionsDisplay.setDirections(result);

                marker.setPosition(result.routes[0].legs[0].start_location);
                markerSecond.setPosition(result.routes[0].legs[0].end_location);
            }
        });

        @if($ride->driver && $ride->status != 'COMPLETED')
        var markerProvider = new google.maps.Marker({
            map: map,
            icon: "/asset/img/marker-car.png",
            anchorPoint: new google.maps.Point(0, -29)
        });

        provider = new google.maps.LatLng({{ $ride->driver->latitude }}, {{ $ride->driver->longitude }});
        markerProvider.setVisible(true);
        markerProvider.setPosition(provider);
        console.log('Drivers Bounds', markerProvider.getPosition());
        bounds.extend(markerProvider.getPosition());
        @endif

        bounds.extend(marker.getPosition());
        bounds.extend(markerSecond.getPosition());
        map.fitBounds(bounds);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ Setting::get('map_key') }}&libraries=places&callback=initMap" async defer></script>
@endsection