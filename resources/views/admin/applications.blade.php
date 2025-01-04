@extends('layouts.admin')

@section('main')

<x-body-heading heading="All Applications" subheading="Manage all admission applications from here."/>






<x-admin.all-applications :records="$records"  />

<x-delete-modal type="Application" message="This will also remove data associated with this Application."/>

@endsection

@push('script')

@endpush
