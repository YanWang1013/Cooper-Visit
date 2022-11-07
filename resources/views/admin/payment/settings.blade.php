@extends('admin.layout.base')

@section('title', 'Payment Settings ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <form action="{{route('admin.settings.payment.store')}}" method="POST">
                {{csrf_field()}}
{{--                <div class="card card-block card-inverse card-primary">--}}
{{--                    <blockquote class="card-blockquote">--}}
{{--                        <i class="fa fa-3x fa-cc-stripe pull-right"></i>--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-xs-4">--}}
{{--                                <label for="stripe_secret_key" class="col-form-label">--}}
{{--                                    @lang('admin.payment.card_payments')--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="col-xs-6">--}}
{{--                                <input @if(Setting::get('CARD') == 1) checked  @endif  name="CARD" id="stripe_check" onchange="cardselect()" type="checkbox" class="js-switch" data-color="#43b968">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="card_field" @if(Setting::get('CARD') == 0) style="display: none;" @endif>--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="stripe_secret_key" class="col-xs-4 col-form-label">@lang('admin.payment.stripe_secret_key')</label>--}}
{{--                                <div class="col-xs-8">--}}
{{--                                    <input class="form-control" type="text" value="{{Setting::get('stripe_secret_key', '') }}" name="stripe_secret_key" id="stripe_secret_key"  placeholder="Stripe Secret key">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="stripe_publishable_key" class="col-xs-4 col-form-label">@lang('admin.payment.stripe_publishable_key')</label>--}}
{{--                                <div class="col-xs-8">--}}
{{--                                    <input class="form-control" type="text" value="{{Setting::get('stripe_publishable_key', '') }}" name="stripe_publishable_key" id="stripe_publishable_key"  placeholder="Stripe Publishable key">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </blockquote>--}}
{{--                </div>--}}

{{--                <div class="card card-block card-inverse card-primary">--}}
{{--                    <blockquote class="card-blockquote">--}}
{{--                        <i class="fa fa-3x fa-money pull-right"></i>--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-xs-4">--}}
{{--                                <label for="cash-payments" class="col-form-label">--}}
{{--                                   @lang('admin.payment.cash_payments') --}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="col-xs-6">--}}
{{--                                <input @if(Setting::get('CASH') == 1) checked  @endif name="CASH" id="cash-payments" onchange="cardselect()" type="checkbox" class="js-switch" data-color="#43b968">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </blockquote>--}}
{{--                </div>--}}
                <h5>@lang('admin.payment.payment_settings')</h5>

                <div class="card card-block card-inverse card-info">
                    <blockquote class="card-blockquote">

                        <div class="form-group row">
                            <label for="tax_percentage" class="col-xs-4 col-form-label">@lang('admin.payment.tax_percentage')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                    type="number"
                                    value="{{ Setting::get('tax_percentage', '0')  }}"
                                    id="tax_percentage"
                                    name="tax_percentage"
                                    min="0"
                                    max="100"
                                    placeholder="Tax Percentage">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="commission_percentage" class="col-xs-4 col-form-label">@lang('admin.payment.commission_percentage')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                    type="number"
                                    value="{{ Setting::get('commission_percentage', '0') }}"
                                    id="commission_percentage"
                                    name="commission_percentage"
                                    min="0"
                                    max="100"
                                    placeholder="Commission percentage">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penalty_fee" class="col-xs-4 col-form-label">@lang('admin.payment.penalty_fee')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                    type="number"
                                    value="{{ Setting::get('penalty_fee', '0') }}"
                                    id="penalty_fee"
                                    name="penalty_fee"
                                    min="0"
                                    max="100"
                                    placeholder="Penalty Fee">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="auto_penalty_fee" class="col-xs-4 col-form-label">@lang('admin.payment.auto_penalty_fee')</label>
                            <div class="col-xs-8">

                                <input class="form-control"
                                       type="number"
                                       value="{{ Setting::get('auto_penalty_fee', '0') }}"
                                       id="auto_penalty_fee"
                                       name="auto_penalty_fee"
                                       min="0"
                                       max="100"
                                       placeholder="Auto Penalty Fee">
                            </div>
                        </div>

                    </blockquote>
                </div>

                <h5>@lang('admin.payment.paypal_settings')</h5>

                <div class="card card-block card-inverse card-info">
                    <blockquote class="card-blockquote">

                        <div class="form-group row">
                            <label for="paypal_mode" class="col-xs-4 col-form-label">@lang('admin.setting.paypal_mode')</label>
                            <div class="col-xs-8">
                                <select class="form-control" id="paypal_mode" name="paypal_mode">
                                    <option value="sandbox" @if(Setting::get('paypal_mode', 0) == 'sandbox') selected @endif>Sandbox</option>
                                    <option value="live" @if(Setting::get('paypal_mode', 0) == 'live') selected @endif>Live</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paypal_client_id" class="col-xs-4 col-form-label">@lang('admin.setting.paypal_client_id')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                       type="text"
                                       value="{{ Setting::get('paypal_client_id', '0') }}"
                                       id="paypal_client_id"
                                       name="paypal_client_id"
                                       placeholder="Paypal Client ID">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paypal_secret" class="col-xs-4 col-form-label">@lang('admin.setting.paypal_secret')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                       type="text"
                                       value="{{ Setting::get('paypal_secret', '0') }}"
                                       id="paypal_secret"
                                       name="paypal_secret"
                                       placeholder="Paypal Secret">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="braintree_env" class="col-xs-4 col-form-label">@lang('admin.setting.braintree_env')</label>
                            <div class="col-xs-8">
                                <select class="form-control" id="braintree_env" name="braintree_env">
                                    <option value="sandbox" @if(Setting::get('braintree_env', 0) == 'sandbox') selected @endif>Sandbox</option>
                                    <option value="live" @if(Setting::get('braintree_env', 0) == 'live') selected @endif>Live</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="braintree_merchant_id" class="col-xs-4 col-form-label">@lang('admin.setting.braintree_merchant_id')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                       type="text"
                                       value="{{ Setting::get('braintree_merchant_id', '0') }}"
                                       id="braintree_merchant_id"
                                       name="braintree_merchant_id"
                                       placeholder="Braintree Merchant ID">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="braintree_public_key" class="col-xs-4 col-form-label">@lang('admin.setting.braintree_public_key')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                       type="text"
                                       value="{{ Setting::get('braintree_public_key', '0') }}"
                                       id="braintree_public_key"
                                       name="braintree_public_key"
                                       placeholder="Braintree Public Key">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="braintree_private_key" class="col-xs-4 col-form-label">@lang('admin.setting.braintree_private_key')</label>
                            <div class="col-xs-8">
                                <input class="form-control"
                                       type="text"
                                       value="{{ Setting::get('braintree_private_key', '0') }}"
                                       id="braintree_private_key"
                                       name="braintree_private_key"
                                       placeholder="Braintree Private Key">
                            </div>
                        </div>

                    </blockquote>
                </div>

                <div class="form-group row">
                    <div class="col-xs-4">
                        <a href="{{ route('admin.index') }}" class="btn btn-warning btn-block">@lang('admin.back')</a>
                    </div>
                    <div class="offset-xs-4 col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block">@lang('admin.payment.update_site_settings')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
function cardselect()
{
    if($('#stripe_check').is(":checked")) {
        $("#card_field").fadeIn(700);
    } else {
        $("#card_field").fadeOut(700);
    }
}
</script>
@endsection