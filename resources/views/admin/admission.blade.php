@extends('layouts.admin')

@section('main')

<x-body-heading heading="Admissions" subheading="Manage all admissions from here."/>






<x-admin.all-admissions  :admissions="$admissions"  />

<x-admin.create-admission :banks="$banks" />

<x-delete-modal type="Admission" message="This will also remove data associated with this admission."/>

@endsection

@push('script')

@endpush
