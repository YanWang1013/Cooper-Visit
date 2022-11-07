@extends('land.layout.app')
@section('header')
    <section class="context-dark">
        <div class="section parallax-container" data-parallax-img="{{asset('asset/img/driver.jpg')}}">
            <div class="material-parallax parallax"><img src="{{asset('asset/img/driver.jpg')}}" alt="" style="display: block; transform: translate3d(-50%, 278px, 0px);"></div>
            <div class="parallax-content">
                <div class="bg-overlay-info">
                    <div class="container section-34 section-md-85 text-lg-left">
                        <div class="d-none d-md-block d-lg-inline-block">
                            <h1>Contact Us</h1>
                        </div>
                        <div class="pull-md-right offset-md-top-10 offset-lg-top-20">
                            <ul class="p list-inline list-inline-dashed">
                                <li class="list-inline-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="list-inline-item">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
<main class="page-content">
    <!-- Get In Touch-->
    <section class="section-top-98 section-md-top-110 section-bottom-15 bg-lighter">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-md-9 col-lg-8 col-xl-12">
                    <div class="row">
                        <div class="col-xl-8 text-left">
                            <h1>Get In Touch</h1>
                            <!-- RD Mailform-->
                            <form class="rd-mailform text-left offset-top-50" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{url('contact')}}">
                                <div class="row">
                                    <div class="col-xl-4 offset-top-20">
                                        <div class="form-group">
                                            <label class="form-label form-label-outside" for="contacts-first-name">Name</label>
                                            <input class="form-control" id="contacts-first-name" type="text" name="name" data-constraints="@Required">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 offset-top-20">
                                        <div class="form-group">
                                            <label class="form-label form-label-outside" for="contacts-email">E-mail</label>
                                            <input class="form-control" id="contacts-email" type="email" name="email" data-constraints="@Required @Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 offset-top-20">
                                        <div class="form-group">
                                            <label class="form-label form-label-outside" for="contacts-phone">Subject</label>
                                            <input class="form-control" id="contacts-phone" type="text" name="subject" data-constraints="@Required">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 offset-top-20">
                                        <div class="form-group">
                                            <label class="form-label form-label-outside" for="contact-me-message">Message</label>
                                            <textarea class="form-control" id="contact-me-message" name="message" data-constraints="@Required" style="height: 160px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-sm-center justify-content-xl-start offset-top-30">
                                    <div class="col-sm-5 col-md-4">
                                        <div class="inset-left-50 inset-right-50 inset-sm-left-0 inset-sm-right-0 inset-xl-right-50">
                                            <button class="btn btn-block btn-primary" type="submit">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-4 text-left offset-top-66 offset-xl-top-0 inset-xl-left-80">
                            <div>
                                <h5>Phone</h5>
                            </div>
                            <div class="offset-top-14 text-subline offset-top-10"></div>
                            <div class="offset-top-20"><span class="icon icon-xxs mdi mdi-cellphone-android text-middle text-info inset-right-10"></span><a class="text-middle p" href="tel:#">+1 (242) 556-1812</a></div>
                            <div class="offset-top-66">
                                <h5>Address</h5>
                            </div>
                            <div class="offset-top-14 text-subline offset-top-10"></div>
                            <div class="unit flex-row unit-spacing-xxs offset-top-20">
                                <div class="unit-left"><span class="icon icon-xxs mdi mdi-map-marker text-middle text-info inset-right-10"></span></div>
                                <div class="unit-body"><a class="text-middle p" href="#"> New Providence, Nassau Bahamas</a></div>
                            </div>
                            <div class="offset-top-66">
                                <h5>Open hours</h5>
                            </div>
                            <div class="offset-top-14 text-subline offset-top-10"></div>
                            <div class="unit flex-row unit-spacing-xxs offset-top-20">
                                <div class="unit-left"><span class="icon icon-xxs mdi mdi-clock text-middle text-info inset-right-10"></span></div>
                                <div class="unit-body">
                                    <div>
                                        <p>Monday–Friday: 9:00am–6:00pm</p>
                                    </div>
                                    <div>
                                        <p>Saturday: 10:00am–4:00pm</p>
                                    </div>
                                    <div>
                                        <p>Sunday: 10:00am–1:00pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
