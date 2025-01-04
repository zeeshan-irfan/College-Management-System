@extends('layouts.user')

@section('main')

<x-body-heading heading="Apply for Admission" subheading="Apply for new admission here."/>




<x-user.admission-form :programs='$programs' :admissions='$admissions' />

@endsection

@push('script')

@endpush
