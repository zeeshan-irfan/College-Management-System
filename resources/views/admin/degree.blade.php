@extends('layouts.admin')

@section('main')

<x-body-heading heading="Degrees" subheading="Manage all degrees from here. These degrees are displayed in admission form according to their type."/>




<x-admin.all-degrees :degrees="$degrees" />
<x-admin.create-degree />

<x-delete-modal type="Degree" message="This will also remove all data assiciated with this degree."/>

@endsection

@push('script')

@endpush
