@extends('layouts.app')

@section('page')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white rounded-0 shadow fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Merited Crown International School
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <span class="badge badge-info">{{ date('Y') }}</span>
                                @lang('Admission')</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-language"></i> Language [{{ app()->getLocale() }}] <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('lang') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('language-en-form').submit();">
                                    {{ __('English') }}
                                </a>

                                <form id="language-en-form" action="{{ route('lang') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="text" name="lang" value="en">
                                </form>

                                <a class="dropdown-item" href="{{ route('lang') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('language-fr-form').submit();">
                                    {{ __('French') }}
                                </a>

                                <form id="language-fr-form" action="{{ route('lang') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="text" name="lang" value="fr">
                                </form>
                            </div>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-alt"></i>
                                    Hello {{ Auth::user()->name }}! <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->isAn('admin'))
                                    <a class="dropdown-item" href="{{ route('pages.index') }}">
                                        {{ __('Pages') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">
                                        {{ __('Roles') }}
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @include('flash::message')

        @yield('banner')

        @hasSection('page_title')
        <div class="container py-4">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="h3">@yield('page_title')</h1>
                </div>

                <div class="col-md-2 text-right">
                    @yield('page_tools')
                </div>
            </div>

            <hr />
        </div>
        @endif

        <section class="container py-4">
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        </section>

        <!--footer starts from here-->
        <footer class="footer">
            <div class="container bottom_border">
                <div class="row">
                    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Find us</h5>
                        <!--headin5_amrc-->
                        <p class="mb10">
                            You need help finding us? You can call use the google map to easily find your way to our premises.
                        </p>
                        <p><i class="fa fa-location-arrow"></i> 113 Rue Ex 7/23 Samandin, Ouagadougou, Burkina Faso.</p>
                        <p><i class="fa fa-phone"></i>  +226 01000431, 01000435, 01000436  </p>
                        <p><i class="fa fa fa-envelope"></i> info@meritedcrown.com  </p>
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li><a href="#" title="About us">@lang('About us')</a></li>
                            <li><a href="#" title="Mission & Vision">@lang('Mission & Vision')</a></li>
                            <li><a href="#" title="Handbook">@lang('Handbook')</a></li>
                            <li><a href="#" title="Scholarship Program">@lang('Scholarship Program')</a></li>
                            <li><a href="#" title="Admission Process">@lang('Admission Process')</a></li>
                            <li><a href="#" title="Course Descriptions">@lang('Course Descriptions')</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                        {{--<div class="row">
                            <div class="col-md-6 pb-4">
                                <img class="img-thumbnail" src="{{ asset('img/placeholder/placeholder-600x400.png') }}" style="width: 120px; height: auto">
                            </div>
                            <div class="col-md-6 pb-4">
                                <img class="img-thumbnail" src="{{ asset('img/placeholder/placeholder-600x400.png') }}" style="width: 120px; height: auto">
                            </div>
                            <div class="col-md-6 pb-4">
                                <img class="img-thumbnail" src="{{ asset('img/placeholder/placeholder-600x400.png') }}" style="width: 120px; height: auto">
                            </div>
                            <div class="col-md-6 pb-4">
                                <img class="img-thumbnail" src="{{ asset('img/placeholder/placeholder-600x400.png') }}" style="width: 120px; height: auto">
                            </div>
                        </div>--}}
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Reminder</h5>
                        <!--headin5_amrc-->
                        <p>
                            @lang("Would you like us to notify you during our next enrollment? Please leave you'r number with us.")
                        </p>
                        <form>
                            <div class="form-group">
                                <label for="telephone-number">Telephone Number</label>
                                <input type="text" class="form-control" name="telephone-number">
                            </div>

                            <button class="btn btn-success btn-block btn-sm">@lang("Please Do!")</button>
                        </form>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">@lang('Newsletter')</h5>
                        <!--headin5_amrc ends here-->

                        <p>
                            @lang("Subscribe to our newsletter to stay updated about school events and activities.")
                        </p>
                        <form>
                            <div class="form-group">
                                <label for="telephone-number">Email</label>
                                <input type="email" class="form-control" name="telephone-number">
                            </div>

                            <button class="btn btn-success btn-block btn-sm">@lang("Subscribe")</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="container">
                <ul class="foote_bottom_ul_amrc">
                    <li><a href="{{ url('/') }}" title="Home">@lang('Home')</a></li>
                    <li><a href="#" title="Cookie">@lang('Cookie')</a></li>
                    <li><a href="#" title="Policy">@lang('Policy')</a></li>
                    <li><a href="#" title="Terms & Conditions">@lang('Terms & Condition')</a></li>
                    <li><a href="{{ route('contact') }}" title="Contact us">@lang('Contact')</a></li>
                </ul>
                <!--foote_bottom_ul_amrc ends here-->
                <p class="text-center">Copyright {{ date('Y') }} | Designed With
                    <span class="text-danger">
                        <i class="fas fa-heart"></i>
                    </span> & Maintained by <a href="#">AcDevelopers</a></p>

                <ul class="social_footer_ul">
                    <li><a href="https://web.facebook.com/meritedCrownInternationalSchool" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
                <!--social_footer_ul ends here-->
            </div>

        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $('#flash-overlay-modal').modal();
    </script>
@endsection