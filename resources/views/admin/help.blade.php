@extends('layouts.admin')

@section('main')

    <x-body-heading heading="Contact Us" subheading="Visit '{{config('app.fullname')}}' at any time or Email us.."/>
    <x-user.email-form />
    <x-location-frame />


    
@endsection