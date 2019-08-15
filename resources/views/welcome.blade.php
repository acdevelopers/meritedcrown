@extends('layouts.page')

@section('banner')
    <!-- Full Page Image Header with Vertically Centered Content -->
    <section class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    {{--<h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
                    <p class="lead">A great starter layout for a landing page</p>--}}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('stylesheets')
    <style>
        body {
            padding-top: 0;
        }

        .masthead {
            height: 100vh;
            min-height: 500px;
            background-image: url({{ asset('img/banners/blackboard.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }
    </style>
@endpush