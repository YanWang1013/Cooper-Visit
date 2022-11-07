@extends('admin.layout.base')

@section('title', 'Dashboard ')

@section('styles')
	<link rel="stylesheet" href="{{asset('main/vendor/jvectormap/jquery-jvectormap-2.0.3.css')}}">
@endsection

@section('content')

<div class="content-area py-1">
<div class="container-fluid">
    <div class="row row-md">
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-info"></span><i class="ti-car"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.Rides')</h6>
					<h1 class="mb-1">{{$rides->count()}}</h1>
					<span class="tag tag-danger mr-0-5">@if($cancel_rides_count == 0) 0.00 @else {{round($cancel_rides_count/$rides->count(),2)}}% @endif</span>
					<span class="text-muted font-90">% down from Cancelled Requests</span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-success"></span><i class="ti-money"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.Revenue')</h6>
					<h1 class="mb-1">{{currency($revenue)}}</h1>
					<i class="fa fa-caret-up text-success mr-0-5"></i><span>from {{$total_rides_count}} Rides</span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-primary"></span><i class="ti-car"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.service')</h6>
					<h1 class="mb-1">{{$service}}</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-warning"></span><i class="ti-flag"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.total_rides')</h6>
					<h1 class="mb-1">{{$cancel_rides_count}}</h1>
					<i class="fa fa-caret-down text-danger mr-0-5"></i><span>for @if($cancel_rides_count == 0) 0.00 @else {{round($cancel_rides_count/$rides->count(),2)}}% @endif Rides</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-md">
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-warning"></span><i class="ti-flag"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.cancel_count')</h6>
					<h1 class="mb-1">{{$user_cancelled_count}}</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-danger"></span><i class="ti-flag"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.provider_cancel_count')</h6>
					<h1 class="mb-1">{{$driver_cancelled_count}}</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-success"></span><i class="ti-flag"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.auto_cancel_count')</h6>
					<h1 class="mb-1">{{$auto_cancelled_count}}</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg-success"></span><i class="ti-calendar"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">@lang('admin.dashboard.scheduled')</h6>
					<h1 class="mb-1">{{$booking_rides_count}}</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-md mb-2">
		<div class="col-md-12">
				<div class="box bg-white">
					<div class="box-block clearfix">
						<h5 class="float-xs-left">@lang('admin.dashboard.Recent_Rides')</h5>
						<div class="float-xs-right">
							<button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-close"></i></button>
						</div>
					</div>
					<table class="table mb-md-0">
						<tbody>
						<?php $diff = ['-success','-info','-warning','-danger']; ?>
						@foreach($rides as $index => $ride)
							<tr>
								<th scope="row">{{$index + 1}}</th>
								<td>{{$ride->user->first_name}} {{$ride->user->last_name}}</td>
								<td>{{$ride->user->email}}</td>
								<td>
{{--									@if($ride->status != $const_ride_status_canceled)--}}
										<a class="text-primary" href="{{route('admin.rides.show',$ride->id)}}"><span class="underline">@lang('admin.dashboard.View_Ride_Details')</span></a>
{{--									@else--}}
{{--										<span>@lang('admin.dashboard.No_Details_Found') </span>--}}
{{--									@endif									--}}
								</td>
								<td>
									<span class="text-muted">{{$ride->created_at->diffForHumans()}}</span>
								</td>
								<td>
									@if($ride->status == \App\Constants::$RIDE_STATUS_FINISHED)
										<span class="tag tag-success">{{ ride_status_msg($ride->status) }}</span>
									@elseif($ride->status == \App\Constants::$RIDE_STATUS_CANCELED)
										<span class="tag tag-danger">{{ ride_status_msg($ride->status) }}</span>
									@else
										<span class="tag tag-info">{{ ride_status_msg($ride->status) }}</span>
									@endif
								</td>
							</tr>
						@endforeach
							
						</tbody>
					</table>
				</div>
			</div>

		</div>

	</div>
</div>
@endsection
