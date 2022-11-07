@extends('admin.layout.base')

@section('title', 'Drivers')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        
        <div class="box box-block bg-white">
            <h5 class="mb-1">@lang('admin.drivers.driver_name'): {{ $Document->driver->first_name }} {{ $Document->driver->last_name }}</h5>
            <h5 class="mb-1">Document: {{ $Document->document->name }}</h5>
            <embed src="{{ url($Document->url) }}" width="100%" height="100%" />

            <div class="row">
                <div class="col-xs-6">
                    <form action="{{ route('admin.driver.document.update', [$Document->driver->id, $Document->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button class="btn btn-block btn-primary" type="submit">@lang('admin.drivers.approve')</button>
                    </form>
                </div>

                <div class="col-xs-6">
                    <form action="{{ route('admin.driver.document.destroy', [$Document->driver->id, $Document->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-block btn-danger" type="submit">@lang('admin.drivers.delete')</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection