@extends('admin.layout.base')

@section('title', 'Add Coupon')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.coupon.add_coupon')</h5>

            <form class="form-horizontal" action="{{route('admin.coupon.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
				<div class="form-group row">
					<label for="coupon_code" class="col-xs-2 col-form-label">@lang('admin.coupon.couponcode')</label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="{{ old('coupon_code') }}" name="coupon_code" required id="coupon_code" placeholder="Coupon Code">
					</div>
				</div>
				<div class="form-group row">
					<label for="discount" class="col-xs-2 col-form-label">@lang('admin.coupon.discount')</label>
					<div class="col-xs-10">
						<input class="form-control" type="number" value="{{ old('discount') }}" name="discount" required id="discount" placeholder="Discount">
					</div>
				</div>
				<div class="form-group row">
					<label for="discount" class="col-xs-2 col-form-label">@lang('admin.coupon.discount_type')</label>
					<div class="col-xs-10">
						<select class="form-control" name="discount_type" required id="discount_type">
						<option value="percent">In Percentage Mode(%)</option>
						<option value="amount">In Amount Mode</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="expiration" class="col-xs-2 col-form-label">@lang('admin.coupon.expiration')</label>
					<div class="col-xs-10">
						<input class="form-control" type="date" value="{{ old('expiration') }}" name="expiration" required id="expiration" placeholder="Expiration">
					</div>
				</div>


				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.coupon.add_coupon')</button>
						<a href="{{route('admin.document.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
