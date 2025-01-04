@extends('layouts.admin')

@section('main')

<x-body-heading heading="Manage Users" subheading="Manage all Users from here."/>



<x-admin.all-users :users="$users" />
<x-admin.create-user />


<x-delete-modal type="User" message="This will also delete data assiciated with this user."/>

@endsection

@push('script')

@endpush
