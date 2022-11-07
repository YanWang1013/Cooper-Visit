@extends('admin.layout.base')

@section('title', 'Places')

@section('content')
<div class="content-area py-1">
    <div class="box box-block bg-white">
        @if(Setting::get('demo_mode') == 1)
            <div class="col-md-12" style="height: 50px; color: red;">
                ** Demo Mode : No Permission to Edit and Delete.
            </div>
        @endif
        <h5 class="mb-1">
            @lang('admin.places.places')
            @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
            @endif
        </h5>
        <a href="{{ route('admin.places.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>@lang('admin.places.add_new_place')</a>
        <table class="table table-striped table-bordered dataTable" id="table-2">
            <thead>
            <tr>
                <th>@lang('admin.id')</th>
                <th>Type</th>
                <th>@lang('admin.places.name')</th>
                <th>@lang('admin.places.address')</th>
                <th>@lang('admin.places.latitude')</th>
                <th>@lang('admin.places.longitude')</th>
                <th>@lang('admin.places.website')</th>
                <th>@lang('admin.places.image')</th>
                <th>@lang('admin.action')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($places as $place)
                <tr>
                @php
                    /**
                     * @var \App\Place $place
                     * @var \App\PlaceType $type
                    **/
                    $type = \App\PlaceType::find($place->type_id);
                    if(isset($type)) $type = $type->display_string; else $type = "Unknown";
                @endphp
                <td>{{ $place->id }}</td>
                <td>{{ $type }}</td>
                <td>{{ $place->name }}</td>
                <td>{{ $place->address }}</td>
                <td>{{ $place->latitude }}</td>
                <td>{{ $place->longitude }}</td>
                <td>{{ $place->website }}</td>
                <td>
                    @if($place->image)
                        <img src="{{$place->image}}" style="height: 50px" >
                    @else
                        ---
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
                                <a href="{{ route('admin.places.edit', $place->id) }}" class="btn btn-default"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.places.delete', $place->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-default look-a-like" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>@lang('admin.delete')</button>
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
                <th>Type</th>
                <th>@lang('admin.places.name')</th>
                <th>@lang('admin.places.address')</th>
                <th>@lang('admin.places.latitude')</th>
                <th>@lang('admin.places.longitude')</th>
                <th>@lang('admin.places.website')</th>
                <th>@lang('admin.places.image')</th>
                <th>@lang('admin.action')</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection