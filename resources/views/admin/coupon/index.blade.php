@extends('admin.layout.base')

@section('title', 'Coupon Codes')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode') == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : No Permission to Edit and Delete.
                    </div>
                @endif
                <h5 class="mb-1">@lang('admin.coupon.couponcodes')</h5>
                <a href="{{ route('admin.coupon.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('coupon')</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.coupon.couponcode') </th>
                            <th>@lang('admin.coupon.discount') </th>
                            <th>@lang('admin.coupon.expiration')</th>
                            <th>@lang('admin.status')</th>
{{--                            <th>@lang('admin.coupon.used_count')</th>--}}
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $index => $coupon)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->discount}}</td>
                            <td>
                                {{date('d-m-Y',strtotime($coupon->expiration))}}
                            </td>
                            <td>
                                @if(date("Y-m-d") <= $coupon->expiration && $coupon->status == 'CREATED')
                                    <span class="tag tag-success">Valid</span>
                                @elseif ($coupon->status == 'USED')
                                    <span class="tag tag-primary">Used</span>
                                @else
                                    <span class="tag tag-danger">Expired</span>
                                @endif
                            </td>
{{--                            <td>--}}
{{--                                {{promo_used_count($coupon->id)}}--}}
{{--                            </td>--}}
                            <td>
                                <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.coupon.couponcode') </th>
                            <th>@lang('admin.coupon.discount') </th>
                            <th>@lang('admin.coupon.expiration')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.coupon.used_count')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection