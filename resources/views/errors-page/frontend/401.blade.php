@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        .li-header-4 .header-bottom {
            background: #293a6c;
            border-top: 1px solid rgba(255,255,255,.1);
            color: #ffffff;
            margin-bottom: 0px;
        }
    </style>
@endsection
@section('content')
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">401 Error</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- Error 404 Area Start -->
            <div class="error404-area pt-30 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="error-wrapper text-center ptb-50 pt-xs-20">
                                <div class="error-text">
                                    <h1>404</h1>
                                    <h2>Opps! UNAUTHORIZED</h2>
                                    <p>You are not authotized for selected action</p>
                                </div>
                                <div class="search-error">
                                    <form id="search-form" action="#">
                                        <input type="text" placeholder="Search">
                                        <button><i class="zmdi zmdi-search"></i></button>
                                    </form>
                                </div>
                                <div class="error-button">
                                    <a href="{{ route('pages.home') }}">Back to home page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Error 404 Area End -->
@endsection