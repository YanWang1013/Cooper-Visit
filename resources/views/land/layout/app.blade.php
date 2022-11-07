<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>coOper App</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="{{ asset('asset/favicon.png') }}"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CUbuntu:400,700">
    <link rel="stylesheet" href="{{asset('land/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('land/css/land.css')}}">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"></div>
    <script src="{{asset('land/js/html5shiv.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<!-- Page-->
<div class="page text-center">
    <header class="page-head">
        <!-- RD Navbar Transparent-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-top-panel rd-navbar-light" data-lg-stick-up-offset="79px" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-stick-up="true">
                <div class="container">
                    <div class="rd-navbar-inner">
                        <div class="rd-navbar-top-panel">
                            <div class="left-side">
                                <address class="contact-info text-left"><span><span class="icon mdi mdi-email"></span><a class="text-middle p text-dark" href="#">support@trycooper.com</a></span></address>
                                {{-- <ul class="list-inline list-inline-sm list-inline-white text-darker">
                                     <li class="list-inline-item"><a class="text-dark fa fa-facebook" href="#"></a></li>
                                     <li class="list-inline-item"><a class="text-dark fa fa-twitter" href="#"></a></li>
                                     <li class="list-inline-item"><a class="text-dark fa fa-google-plus" href="#"></a></li>
                                     <li class="list-inline-item"><a class="text-dark fa fa-youtube" href="#"></a></li>
                                     <li class="list-inline-item"><a class="text-dark fa fa-linkedin" href="#"></a></li>
                                 </ul>--}}
                            </div>
                            <div class="center">
                                <address class="contact-info text-left"><span><span class="icon mdi mdi-map-marker"></span><a class="text-middle p text-dark" href="#">New Providence, Nassau Bahamas</a></span></address>
                            </div>
                            <div class="right-side">
                                <address class="contact-info text-left"><span><span class="icon mdi mdi-cellphone-android"></span><a class="text-middle p font-weight-bold text-dark" href="tel:#">+1 (242) 556-1812</a> <span class="p text-info text-middle">Gilbert Cassar II</span></span></address>
                            </div>
                        </div>
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <!-- RD Navbar Toggle-->
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap"><span></span></button>
                            <!-- RD Navbar Top Panel Toggle-->
                            <button class="rd-navbar-top-panel-toggle" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-top-panel"><span></span></button>
                            <!--Navbar Brand-->
                            <div class="rd-navbar-brand"><a href="{{url('/')}}"><img height='31' src='{{asset('asset/logo-black.png')}}' alt=''/></a></div>
                        </div>
                        <div class="rd-navbar-menu-wrap">
                            <div class="rd-navbar-nav-wrap">
                                <div class="rd-navbar-mobile-scroll">
                                    <!--Navbar Brand Mobile-->
                                    <div class="rd-navbar-mobile-brand"><a href="{{url('/')}}"><img  height='31' src='{{asset('asset/logo-black.png')}}' alt=''/></a></div>
                                    <!-- RD Navbar Nav-->
                                    <ul class="rd-navbar-nav">
                                        <li ><a href="{{url('/admin/login')}}"><span><i class="fa fa-"></i> Log In</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        @yield('header')
    </header>
    <!-- Page Contents-->
    @yield('content')
    <!-- Page Footer-->
    <!-- Footer variant 3-->
    <footer class="section-relative section-top-66 section-bottom-34 page-footer {{ Request::segment(1)=='terms'||Request::segment(1)=='privacy'?'bg-lighter':'' }}">
        <div class="container">
            <div class="row justify-content-md-center text-xl-left">
                <div class="col-md-12">
                    <div class="row justify-content-sm-center">
                        <div class="col-sm-10 col-md-3 offset-top-66 order-md-1 offset-md-top-0 col-md-6 col-xl-3 order-xl-1">
                            <!-- Footer brand-->
                            <div class="footer-brand"><a href="{{url('/')}}"><img style="width: 15rem" src='{{asset('asset/logo-black.png')}}' alt=''/></a></div>
                            <div class="contact-info offset-top-20 p">

                            </div>
                        </div>
                        <div class="col-sm-10 col-md-3 offset-top-66 order-md-2 col-md-6 col-xl-4 offset-md-top-0 order-xl-3 offset-xl-top-10">
                            <h6 class="text-uppercase text-spacing-60 text-center text-lg-left">Links</h6>
                            <div>
                                <p class="my-1"><a style="text-decoration: none" href="{{url('/')}}">Home</a> </p>
                                <p class="my-1"><a style="text-decoration: none" href="{{url('terms')}}">Terms Of Use</a> </p>
                                <p class="my-1"><a style="text-decoration: none" href="{{url('privacy')}}">Privacy Policy</a> </p>
                            </div>
                        </div>
                        <div class="col-sm-10 col-md-3 offset-top-66 order-md-2 col-md-6 col-xl-4 offset-md-top-0 order-xl-3 offset-xl-top-10">
                            <h6 class="text-uppercase text-spacing-60 text-center text-lg-left">Support Teams</h6>
                            <div>
                                <p class="my-1"><span style="font-size: 18px;margin-right: 8px" class="fa fa-map-marker"></span> New Providence, Nassau Bahamas</p>
                                <p class="my-1"><span style="font-size: 15px;margin-right: 8px" class="fa fa-envelope"></span><a href="mailto:support@trycooper.com">support@trycooper.com</a> </p>
                                <p class="my-1"><span style="font-size: 22px;margin-right: 8px" class="fa fa-mobile"></span> +1 (242) 556-1812</p>
                                <p class="my-1"> </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container offset-top-50">
            <p>Cooper Technologies Inc. &copy; <span id="copyright-year"></span> . <a class="text-darker" href="#">Privacy Policy</a>
                <!-- {%FOOTER_LINK}-->
            </p>
        </div>
    </footer>
</div>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- PhotoSwipe Gallery-->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<!-- Java script-->
<script src="{{asset('land/js/core.min.js')}}"></script>
<script src="{{asset('land/js/script.js')}}"></script>
@yield('script')
</body>
</html>
