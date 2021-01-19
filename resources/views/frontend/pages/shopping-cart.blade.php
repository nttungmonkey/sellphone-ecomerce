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
    <ngcart-cart template-url="{{ asset('vendor/ngCart/template/ngCart/cart.html') }}"></ngcart-cart>
@endsection