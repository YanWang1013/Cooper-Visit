@extends('admin.layout.base')

@section('title', 'Ride History ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            @if(Setting::get('demo_mode') == 1)
        <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
                @endif
            <h5 class="mb-1">Ride History</h5>
            @if(count($rides) != 0)
            <table class="table table-striped table-bordered dataTable" id="table-4">
                <thead>
                    <tr>
                        <th>#</th>
{{--                        <th>@lang('admin.rides.Booking_ID')</th>--}}
                        <th>@lang('admin.rides.User_Name')</th>
                        <th>@lang('admin.rides.Provider_Name')</th>
                        <th>@lang('admin.rides.Date_Time')</th>
                        <th>@lang('admin.rides.s_address')</th>
                        <th>@lang('admin.rides.d_address')</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.rides.distance')</th>
                        <th>@lang('admin.amount')</th>
                        <th>@lang('admin.rides.Payment_Mode')</th>
                        <th>@lang('admin.rides.Payment_Status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rides as $index => $ride)
                    <tr>
                        <td>{{ $ride->id }}</td>
                        <td>
                            @if($ride->driver)
                                {{ $ride->user?$ride->user->first_name:'' }} {{ $ride->user?$ride->user->last_name:'' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($ride->driver)
                                {{ $ride->driver?$ride->driver->first_name:'' }} {{ $ride->driver?$ride->driver->last_name:'' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($ride->created_at)
                                <span class="text-muted">{{$ride->created_at->diffForHumans()}}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $ride->s_address }}</td>
                        <td>{{ $ride->d_address }}</td>
                        <td>{{ ride_status_msg($ride->status) }}</td>
                        <td>{{ $ride->distance ? round($ride->distance/1000, 2) : '-' }}</td>
                        <td>
                            @if($ride->pay_amount)
                                {{ currency($ride->pay_amount) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $ride->payment_method }}</td>
                        <td>
                            @if($ride->pay_at)
                                Paid
                            @else
                                Not Paid
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.rides.show', $ride->id) }}" class="dropdown-item">
                                        <i class="fa fa-search"></i> More Details
                                    </a>
                                    <form action="{{ route('admin.rides.destroy', $ride->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        @if( Setting::get('demo_mode') == 0)
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
{{--                        <th>@lang('admin.rides.Booking_ID')</th>--}}
                        <th>@lang('admin.rides.User_Name')</th>
                        <th>@lang('admin.rides.Provider_Name')</th>
                        <th>@lang('admin.rides.Date_Time')</th>
                        <th>@lang('admin.rides.s_address')</th>
                        <th>@lang('admin.rides.d_address')</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.rides.distance')</th>
                        <th>@lang('admin.amount')</th>
                        <th>@lang('admin.rides.Payment_Mode')</th>
                        <th>@lang('admin.rides.Payment_Status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
            @else
            <h6 class="no-result">No results found</h6>
            @endif 
        </div>
    </div>
</div>
@endsection