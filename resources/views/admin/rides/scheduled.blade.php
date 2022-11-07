@extends('admin.layout.base')

@section('title', 'Scheduled Rides ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                <h5 class="mb-1">Scheduled Rides</h5>
                @if(count($rides) != 0)
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.rides.Request_Id')</th>
                            <th>@lang('admin.rides.User_Name')</th>
                            <th>@lang('admin.rides.Provider_Name')</th>
                            <th>@lang('rides')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.rides.Payment_Mode')</th>
                            <th>@lang('admin.rides.Payment_Status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rides as $index => $ride)
                        <tr>
                            <td>{{$index + 1}}</td>

                            <td>{{$ride->id}}</td>
                            <td>{{$ride->user?$ride->user->first_name:''}} {{$ride->user?$ride->user->last_name:''}}</td>
                            <td>
                                @if($ride->driver_id)
                                    {{$ride->driver?$ride->driver->first_name:''}} {{$ride->driver?$ride->driver->last_name:''}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{$ride->schedule_at}}</td>
                            <td>
                                {{$ride->status}}
                            </td>

                            <td>{{$ride->payment_mode}}</td>
                            <td>
                                @if($ride->paid)
                                    Paid
                                @else
                                    Not Paid
                                @endif
                            </td>
                            <td>
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.rides.show', $ride->id) }}" class="btn btn-default"><i class="fa fa-search"></i> More Details</a>
                                    </li>
                                  </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.rides.Request_Id')</th>
                            <th>@lang('admin.rides.User_Name')</th>
                            <th>@lang('admin.rides.Provider_Name')</th>
                            <th>@lang('admin.rides.Scheduled_Date_Time')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.rides.Payment_Mode')</th>
                            <th>@lang('rides')</th>
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