@extends('layouts.admin')

@section('main')

<x-body-heading heading="Programs" subheading="Manage all programs from here."/>



<x-admin.all-programs :programs="$programs" />
<x-admin.create-program :departments="$departments" />


<x-delete-modal type="Program" message="This will also remove data, assiciated with this program."/>

@endsection

@push('script')

@endpush
