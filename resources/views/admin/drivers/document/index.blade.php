
@extends('admin.layout.base')

@section('title', 'Drivers')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
          @if(Setting::get('demo_mode') == 1)
                <div class="col-md-12" style="height:50px;color:red;">
                    <h1>** Demo Mode : No Permission to Edit and Delete.</h1>
                </div>
             @endif

            <div class="row">
                <h5 class="mb-1" style="color:red; margin-left:300px;">{{$driver->first_name.' '.$driver->last_name.' ('.$driver->email.')'}}</h5><hr>
            </div>
            <h5 class="mb-1">@lang('admin.drivers.type_allocation')</h5>
            <div class="row">
                <div class="col-xs-12">
                    @if($profile->count() > 0)
                    <hr><h6>Allocated Vehicle Category :  </h6>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>@lang('admin.drivers.service_name')</th>
                                <th>@lang('admin.service.Provider_Name')</th>
                                <th>@lang('admin.drivers.service_number')</th>
                                <th>@lang('admin.drivers.service_model')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profile as $p)
                            <tr>
                                <td>{{ $p->service_type_info->name }}</td>
                                <td>{{ $p->service_type_info->driver_name }}</td>
                                <td>{{ $p->car_number }}</td>
                                <td>{{ $p->car_model }}</td>
{{--                                <td>--}}
{{--                                @if( Setting::get('demo_mode') == 0)--}}
{{--                                    <form action="{{ route('admin.driver.document.service', [$Driver->id, $profile->id]) }}" method="POST">--}}
{{--                                        {{ csrf_field() }}--}}
{{--                                        {{ method_field('DELETE') }}--}}
{{--                                        <button class="btn btn-danger btn-large btn-block">Delete</button>--}}
{{--                                    </form>--}}
{{--                                     @endif--}}
{{--                                </td>--}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    <hr>
                </div>
                <div class="col-xs-12">
                    @if($new_service_type)
                        <hr><h6>New Vehicle Category :  </h6>
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th>@lang('admin.drivers.service_name')</th>
                                <th>@lang('admin.service.Provider_Name')</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $new_service_type->name }}</td>
                                    <td>{{ $new_service_type->driver_name }}</td>
                                    <td>
                                        <form action="{{ route('admin.driver.new_service', $driver->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger btn-large btn-block">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <hr>
                </div>
{{--                <form action="{{ route('admin.driver.document.store', $Driver->id) }}" method="POST">--}}
{{--                    {{ csrf_field() }}--}}
{{--                    <div class="col-xs-3">--}}
{{--                        <select class="form-control input" name="service_type" required>--}}
{{--                            @forelse($ServiceTypes as $Type)--}}
{{--                            <option value="{{ $Type->id }}">{{ $Type->name }}</option>--}}
{{--                            @empty--}}
{{--                            <option>- Please Create a Service Type -</option>--}}
{{--                            @endforelse--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-3">--}}
{{--                        <input type="text" required name="service_number" class="form-control" placeholder="Number (CY 98769)">--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-3">--}}
{{--                        <input type="text" required name="service_model" class="form-control" placeholder="Model (Audi R8 - Black)">--}}
{{--                    </div>--}}
{{--                    @if( Setting::get('demo_mode') == 0)--}}
{{--                    <div class="col-xs-3">--}}
{{--                        <button class="btn btn-primary btn-block" type="submit">Update</button>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </form>--}}
            </div>
        </div>

        <div class="box box-block bg-white">
            <h5 class="mb-1">@lang('admin.drivers.provider_documents')</h5>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.drivers.document_type')</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($driver->documents as $index => $document)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $document->document->name}}</td>
                        <td>{{ $document->status }}</td>
                        <td>
                            <div class="input-group-btn">
                            @if( Setting::get('demo_mode') == 0)
                                <a href="{{ route('admin.driver.document.edit', [$driver->id, $document->id]) }}"><span class="btn btn-success btn-large">View</span></a>
                                <button class="btn btn-danger btn-large" form="form-delete">Delete</button>
                                <form action="{{ route('admin.driver.document.destroy', [$driver->id, $document->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.drivers.document_type')</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection