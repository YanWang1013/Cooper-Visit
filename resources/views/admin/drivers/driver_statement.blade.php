@extends('admin.layout.base')

@section('title', $page)

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            	<h3>{{$page}}</h3>

            	<div class="row">

						<div class="row row-md mb-2" style="padding: 15px;">
							<div class="col-md-12">
									<div class="box bg-white">
										<div class="box-block clearfix">
											<h5 class="float-xs-left">Earnings</h5>
											<div class="float-xs-right">
											</div>
										</div>

										@if(count($drivers) != 0)
								            <table class="table table-striped table-bordered dataTable" id="table-2">
								                <thead>
								                   <tr>
														<td>@lang('admin.drivers.driver_name')</td>
														<td>@lang('admin.mobile')</td>
														<td>@lang('admin.status')</td>
														<td>@lang('admin.drivers.Total_Rides')</td>
														<td>@lang('admin.drivers.Total_Earning')</td>
														<td>@lang('admin.drivers.Commission')</td>
														<td>@lang('admin.drivers.Joined_at')</td>
														<td>@lang('admin.drivers.Details')</td>
													</tr>
								                </thead>
								                <tbody>
								                <?php $diff = ['-success','-info','-warning','-danger']; ?>
														@foreach($drivers as $index => $driver)
															<tr>
																<td>
																	{{$driver->first_name}} 
																	{{$driver->last_name}}
																</td>
																<td>
																	{{$driver->phone_number}}
																</td>
																<td>
																	@if($driver->status == \App\Constants::$DRIVER_STATUS_ACTIVED)
																		<span class="tag tag-success">{{driver_status_msg($driver->status)}}</span>
																	@elseif($driver->status == \App\Constants::$DRIVER_STATUS_ACTIVED)
																		<span class="tag tag-danger">{{driver_status_msg($driver->status)}}</span>
																	@else
																		<span class="tag tag-info">{{driver_status_msg($driver->status)}}</span>
																	@endif
																</td>
																<td>
																	@if($driver->rides_count)
																		{{$driver->rides_count}}
																	@else
																	 	-
																	@endif
																</td>
																<td>
																	@if($driver->revenue)
																		{{currency($driver->revenue)}}
																	@else
																	 	-
																	@endif
																</td>
																<td>
																	@if($driver->commission)
																		{{currency($driver->commission)}}
																	@else
																	 	-
																	@endif
																</td>
																<td>
																	@if($driver->created_at)
																		<span class="text-muted">{{$driver->created_at->diffForHumans()}}</span>
																	@else
																	 	-
																	@endif
																</td>
																<td>
																	<a href="{{route('admin.driver.statement', $driver->id)}}">View by Ride</a>
																</td>
															</tr>
														@endforeach
															
								                <tfoot>
								                    <tr>
														<td>@lang('admin.drivers.driver_name')</td>
														<td>@lang('admin.mobile')</td>
														<td>@lang('admin.status')</td>
														<td>@lang('admin.drivers.Total_Rides')</td>
														<td>@lang('admin.drivers.Total_Earning')</td>
														<td>@lang('admin.drivers.Commission')</td>
														<td>@lang('admin.drivers.Joined_at')</td>
														<td>@lang('admin.drivers.Details')</td>
													</tr>
								                </tfoot>
								            </table>
								            @else
								            <h6 class="no-result">No results found</h6>
								            @endif 

									</div>
								</div>

							</div>

            	</div>

            </div>
        </div>
    </div>

@endsection
