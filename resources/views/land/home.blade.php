@extends('land.layout.app')
@section('header')
    <div class="section parallax-container" data-parallax-img="{{asset('main/assets/img/photos-1/3.jpg')}}">
        <div class="parallax-content">
            <div class="bg-overlay-info" style="background: rgba(179, 214, 245, 0.23)">
                <div class="container container-wide">
                    <div class="row justify-content-sm-center align-items-sm-center">
                        <div class="col-md-12 section-254"><img class="img-fluid d-inline-block" src="{{asset('land/images/logo-white.png')}}" style="width: 20rem;" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <main class="page-content">
        <!-- Welcome to Intense-->
        <section class="section-98 section-md-110">
            <div class="container">
                <div class="row justify-content-sm-center align-items-sm-center">
                    <!-- Simple quote Slider-->
                    <div class="col-md-9 col-xl-6 order-xl-6">
                        <div class="owl-carousel owl-carousel-classic owl-carousel-class-light shadow-drop-md" data-items="1" data-nav="false" data-dots="false" data-nav-custom=".owl-custom-navigation">
                            <div>
                                <!-- Media Elements-->
                                <div class="embed-responsive embed-custom-16by9">
                                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/mP07Oyr7enQ"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xl-6 col-xl-pull-6 text-xl-left offset-top-66 offset-xl-top-0 inset-xl-right-30">
                        <h1>how to ride</h1>
                        <hr class="divider bg-mantis hr-xl-left-0">
                        <p class="text-md-left">Using cOoper is really simple and intuitive, but we have created a few YouTube videos to show you exactly how to do each feature in coOper for your reference when ever you need to!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-98 section-md-top-110 section-md-bottom-124 bg-polar">
            <div class="container container-wide">
                <h1>POPULAR ATTRACTIONS</h1>
                <hr class="divider bg-mantis">
                <p class="offset-top-50">Our islands play host to numerous natural and manmade attractions that offer a glimpse into our rich culture.<br>Guided tours offered are both educational and exciting, and you should try as many as possible to get the full Bahamian experience. You can walk, or go by bike, jeep, or scooter.</p>
                <div class="row justify-content-sm-center offset-top-66 text-md-left">
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/atlantis.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">ATLANTIS</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-md-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/bahamar.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">BAHAMAR</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/beach.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">PARADISE ISLAND BEACH</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/blue-hole.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">BLUE HOLE</a></h5>
                    </div>
                    <!-- next range-->
                    <div class="row-spacer d-none d-xxl-inline-block offset-top-66"></div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/mosaic.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">MOSAIC CASUAL DINING</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/paradise-island.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">PARADISE ISLAND</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/point.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">THE POINT RESTAURANT</a></h5>
                    </div>
                    <div class="col-sm-10 col-md-6 col-xl-5 col-xxl-3 offset-top-50 offset-xxl-top-0"><a class="thumbnail-classic" href="javascript:void(0)" target="_self">
                            <figure><img width="420" height="310" src="{{asset('land/images/sipsip.jpg')}}" alt=""/>
                            </figure></a>
                        <h5 class="text-info"><a href="javascript:void(0)">SIP SIP RESTAURANT</a></h5>
                    </div>
                </div>

            </div>
        </section>
        <div class="container container-wide">
            <hr class="hr bg-gray">
        </div>
        <!-- How we can help?-->

    </main>
@endsection
