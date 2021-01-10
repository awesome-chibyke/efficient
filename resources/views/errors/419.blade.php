@extends('errors::minimal')

@section('title', __('Page Expired'))
{{--@section('code', '404')--}}
@section('message', __('Page Expired, please click the button below to go back to the home page'))
@section('home_button')

    <div style="display: block"><a href="/" style="padding:20px 20px; background: #0e0b2b; color:white; font-size: 13px; text-align: center; margin-left: 2rem;">Home</a></div>

@endsection
