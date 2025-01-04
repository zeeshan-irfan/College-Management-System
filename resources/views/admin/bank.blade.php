@extends('layouts.admin')

@section('main')

<x-body-heading heading="Banks" subheading="Manage all banks from here. These details are used to generate challans."/>


<x-admin.all-banks :banks="$banks" />

<x-admin.create-bank />


<x-delete-modal type="Bank" message="This will also remove all data assiciated with this bank."/>

@endsection

@push('script')

@endpush
