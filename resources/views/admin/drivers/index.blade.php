@extends('admin.layout.base')

@section('title', 'Providers ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            @if(Setting::get('demo_mode') == 1)
        <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
                @endif
            <h5 class="mb-1">
                @lang('drivers')
                @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
                @endif
            </h5>
{{--            <a href="{{ route('admin.driver.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>@lang('admin.drivers.add_new_provider')</a>--}}
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.drivers.full_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.drivers.total_requests')</th>
                        <th>@lang('admin.drivers.finished_requests')</th>
                        <th>@lang('admin.drivers.cancelled_requests')</th>
                        <th>@lang('admin.drivers.documents')</th>
                        <th>@lang('admin.drivers.service_type')</th>
                        <th>@lang('admin.drivers.online')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($drivers as $index => $driver)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $driver->first_name }} {{ $driver->last_name }}</td>
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>{{ substr($driver->email, 0, 3).'****'.substr($driver->email, strpos($driver->email, "@")) }}</td>
                        @else
                        <td>{{ $driver->email }}</td>
                        @endif
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>+919876543210</td>
                        @else
                        <td>{{ $driver->phone_number }}</td>
                        @endif
                        <td>{{ $driver->total_rides }}</td>
                        <td>{{ $driver->finished_rides }}</td>
                        <td>{{ $driver->canceled_rides }}</td>
                        <td>
                            @if($driver->pending_documents() > 0)
                                <a class="btn btn-danger btn-block label-right" href="{{route('admin.driver.document.index', $driver->id )}}">Attention! <span class="btn-label">{{ $driver->pending_documents() }}</span></a>
                            @else
                                <a class="btn btn-primary btn-block" href="{{route('admin.driver.document.index', $driver->id )}}">All Set!</a>
                            @endif
                        </td>
                        <td>
                            @if($driver->profile->service_type_info)
                                {{ $driver->profile->service_type_info->name }}
                            @endif
                            @if($driver->profile->new_service_type_info)
                                <a class="btn btn-danger btn-block label-right" href="{{route('admin.driver.document.index', $driver->id )}}">
                                    {{ $driver->profile->new_service_type_info->name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($driver->status == \App\Constants::$DRIVER_STATUS_ACTIVED || $driver->status == \App\Constants::$DRIVER_STATUS_TRAVELED)
                                <a class="btn btn-primary btn-block" style="color:white">ON</a>
                            @else
                                <a class="btn btn-danger btn-block" style="color:white">OFF</a>
                            @endif

                        </td>
                        <td>
                            <div class="input-group-btn">
                                <button type="button" 
                                    class="btn btn-info btn-block dropdown-toggle"
                                    data-toggle="dropdown">@lang('admin.action')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.driver.ride', $driver->id) }}" class="btn btn-default"><i class="fa fa-search"></i> @lang('admin.History')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.driver.statement', $driver->id) }}" class="btn btn-default"><i class="fa fa-account"></i> @lang('admin.Statements')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.driver.payment_history', $driver->id) }}" class="btn btn-default"><i class="fa fa-account"></i> @lang('admin.payment.payment_history')</a>
                                    </li>
                                    @if( Setting::get('demo_mode') == 0)
                                    <li>
                                        <a href="{{ route('admin.driver.edit', $driver->id) }}" class="btn btn-default"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    </li>
                                    @endif
                                    <li>
                                        <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            @if( Setting::get('demo_mode') == 0)
                                            <button class="btn btn-default look-a-like" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>@lang('admin.delete')</button>
                                            @endif
                                        </form>
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
                        <th>@lang('admin.drivers.full_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.drivers.total_requests')</th>
                        <th>@lang('admin.drivers.accepted_requests')</th>
                        <th>@lang('admin.drivers.cancelled_requests')</th>
                        <th>@lang('admin.drivers.documents')</th>
                        <th>@lang('admin.drivers.service_type')</th>
                        <th>@lang('admin.drivers.online')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection