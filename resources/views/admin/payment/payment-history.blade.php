@extends('admin.layout.base')

@section('title', 'Payment History ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1">@lang('admin.payment.payment_history')</h5>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.payment.id')</th>
                            <th>@lang('admin.payment.email')</th>
                            <th>@lang('admin.payment.from')</th>
                            <th>@lang('admin.payment.to')</th>
                            <th>@lang('admin.payment.total_amount')</th>
                            <th>@lang('admin.payment.real_amount')</th>
                            <th>@lang('admin.payment.fee')</th>
                            <th>@lang('admin.payment.cooper_fee')</th>
                            <th>@lang('admin.payment.purpose')</th>
                            <th>@lang('admin.payment.payment_method')</th>
                            <th>@lang('admin.payment.payment_status')</th>
                            <th>@lang('admin.payment.currency')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $index => $payment)
                        <tr>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->email}}</td>
                            <td>{{$payment->uname}}</td>
                            <td>{{$payment->dname}}</td>
                            <td>{{currency($payment->total)}}</td>
                            <td>{{currency($payment->amount)}}</td>
                            <td>{{currency($payment->pp_fee)}}</td>
                            <td>{{currency($payment->cooper_fee)}}</td>
                            <td>{{$payment->purpose}}</td>
                            <td>{{$payment->payment_method}}</td>
                            <td>{{$payment->status}}</td>
                            <td>{{$payment->currency}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.payment.request_id')</th>
                            <th>@lang('admin.payment.email')</th>
                            <th>@lang('admin.payment.from')</th>
                            <th>@lang('admin.payment.to')</th>
                            <th>@lang('admin.payment.total_amount')</th>
                            <th>@lang('admin.payment.real_amount')</th>
                            <th>@lang('admin.payment.fee')</th>
                            <th>@lang('admin.payment.cooper_fee')</th>
                            <th>@lang('admin.payment.purpose')</th>
                            <th>@lang('admin.payment.payment_method')</th>
                            <th>@lang('admin.payment.payment_status')</th>
                            <th>@lang('admin.payment.currency')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection