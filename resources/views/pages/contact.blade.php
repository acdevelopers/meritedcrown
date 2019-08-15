@extends('layouts.page')
@section('page_title', 'Contact us')
@section('meta_description', 'Global contact page Merited Crown International School')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- Section Titile -->
                <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                    <h1 class="section-title">Love to Hear From You</h1>
                </div>
            </div>
            <div class="row">
                <!-- Section Titile -->
                <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>

                    <div class="find-widget">
                        Company:  <a href="{{ url('/') }}">Merited Crown International School</a>
                    </div>
                    <div class="find-widget">
                        Address: <a href="#">Port No 113 Rue Ex 7/23 Samandin, Ouagadougou, Burkina Faso</a>
                    </div>
                    <div class="find-widget">
                        Phone:  <a href="#">+226 01000431, 01000435, 01000436</a>
                    </div>

                    <div class="find-widget">
                        Website:  <a href="https://uny.ro">www.meritedcrown.com</a>
                    </div>
                    <div class="find-widget">
                        Program: <a href="#">Mon to Friday: 07:30 AM - 02:30 PM</a>
                    </div>
                </div>
                <!-- contact form -->
                <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                    <form class="shake" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator">
                        <!-- Name -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" required data-error="Please enter your name">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- email -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" required data-error="Please enter your Email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Subject -->
                        <div class="form-group label-floating">
                            <label class="control-label">Subject</label>
                            <input class="form-control" id="msg_subject" type="text" name="subject" required data-error="Please enter your message subject">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Message -->
                        <div class="form-group label-floating">
                            <label for="message" class="control-label">Message</label>
                            <textarea class="form-control" rows="3" id="message" name="message" required data-error="Write your message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Form Submit -->
                        <div class="form-submit mt-5">
                            <button class="btn btn-success btn-sm btn-block" type="submit" id="form-submit">
                                <i class="fas fa-send"></i> Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection