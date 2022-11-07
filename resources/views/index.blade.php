@extends('user.layout.app')

@section('content')
<div class="banner row no-margin" style="background-image: url('{{ asset('asset/img/driver.jpg') }}');">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
            <h2 class="banner-head"><span class="strong">Time Awaits You!</span><br>Reliable & Efficient peer-to-peer transportation! See Rider Tips & Exclusive Driver's Guide Below</h2>
        </div>
    </div>
</div>

<div class="row white-section no-margin">
    <div class="container">
        <div class="col-md-6 img-block text-center"> 
            <img src="{{ asset('asset/img/Rider-Tips2.png') }}">
        </div>
        <div class="col-md-6 content-block">
            <h2>Videos to teach you how to ride!</h2>
            <div class="title-divider"></div>
            <p>Using cOoper is really simple and intuitive, but we have created a few YouTube videos to show you exactly how to do each feature in coOper for your reference when ever you need to!</p>
            <a class="content-more" href="#">HOW TO RIDE TIPS<i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

<div class="row gray-section no-margin">
    <div class="container">                
        <div class="col-md-6 content-block">
            <h2>Driver's Training Area</h2>
            <div class="title-divider"></div>
            <p>Dear coOper Driver's, as you know, we take our customer experience very seriously at coOper, and therefore there are training resources we make available to you in order to keep you on point!</p>
            <a class="content-more" href="#">DRIVER'S GUIDE<i class="fa fa-chevron-right"></i></a>
        </div>
        <div class="col-md-6 img-block text-center"> 
            <img src="{{ asset('asset/img/Driver-Coop2.png') }}">
        </div>
    </div>
</div>

<div>
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <center><h2 style="color:#E67817; font-weight:10000">Search our coOper Database of Attractions and Popular Places</h2>  
        <form>
            <div class="input-group find-form">
                <input type="text" class="form-control" placeholder="Search" >
                <span class="input-group-addon">
                    <button type="submit">
                        <i class="fa fa-arrow-right"></i>
                    </button>  
                    </span>
            </div>
        </form>
    </center>
        <br>
        <br>
        <br>
        <br>
        <img src="https://visit.trycooper.com/asset/img/Nassau-New-Providence-Island-Map.jpg" alt="Nassau-New-Providence-Island-Map" width="100%">
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
@endsection