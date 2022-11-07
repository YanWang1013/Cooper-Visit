@extends('user.layout.auth')

@section('content')

<?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>
<div class="full-page-bg" style="background-image: url({{$login_user}});">
<div class="log-overlay"></div>
    <div class="full-page-bg-inner">
        <div class="row no-margin">
            <div class="col-md-6 log-left">
                <span class="login-logo">src="{{ asset('logo-black.png') }}"</span>
                <h2><b>We all forget sometimes...</b></h2>
                <b><p>coOper App has your back, as usual. Start ordering your next coOper ride soon!</p></b>
            </div>
            <div class="col-md-6 log-right">
                <div class="login-box-outer">
                <div class="login-box row no-margin">
                    <div class="col-md-12">
                        <a class="log-blk-btn" href="{{url('login')}}">ALREADY HAVE AN ACCOUNT?</a>
                        <h3>Reset Your coOper rider Password</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif                        
                        </div>

                        
                        <div class="col-md-12">
                            <button class="log-teal-btn" type="submit">SEND RESET PASSWORD NOW LINK</button>
                        </div>
                    </form>     

                    <div class="col-md-12">
                        <p class="helper">Or <a href="{{route('login')}}">Login Now</a> with your coOper rider account.</p>   
                    </div>

                </div>


                <div class="log-copy"><p class="no-margin">© 2019 CoOper App Ltd.</p></div>
                </div>
            </div>
        </div>
    </div>
@endsection
