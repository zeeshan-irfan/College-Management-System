@extends('layouts.admin')

@section('main')

<x-body-heading heading="Departments" subheading="Manage all departments from here."/>



<x-admin.all-departments />
<x-admin.create-department />


<x-delete-modal type="Department" message="This will also remove programs, student data, etc., assiciated with this department."/>

@endsection

@push('script')

@endpush
