@extends('frontend.layouts.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="er404">
        
    </div>

    
    <h1 class="infor">
        Hiện không tìm thấy trang này! Xin vui lòng kiểm tra lại URL hoặc quay lại trang chủ.
    </h1>
    <p class="text-center"> 
        <a href="/" class="btn btn-outline-primary btn-lg"> Trang chủ</a>
    </p>
</div>
   

@endsection