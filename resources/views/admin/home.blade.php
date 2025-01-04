@extends('layouts.admin')

@section('main')

<x-body-heading heading="Dashboard" subheading="View overall details here."/>

<x-admission-notification button="See Details" route="admission.index"/>

<div class="container-fluid">
    <div class="row">
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($recordsCount) ? $recordsCount : 0 }}" sign="Total" heading="Applications" subheading="applied" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($departmentsCount) ? $departmentsCount : 0 }}" sign="Total" heading="Departments" subheading="active" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($programsCount) ? $programsCount : 0 }}" sign="Total" heading="Programs" subheading="active" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($degreesCount) ? $degreesCount : 0 }}" sign="Total" heading="Degrees" subheading="added" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($usersCount) ? $usersCount : 0 }}" sign="Total" heading="Users" subheading="registered" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($banksCount) ? $banksCount : 0 }}" sign="Total" heading="Banks" subheading="added" />
    </div>
</div>


@endsection

@push('script')
<script>
    $(document).ready(function () {
        // Animate counters
        $(".counter").each(function () {
            var $this = $(this);
            var endValue = parseInt($this.data("end"));

            $({ count: 0 }).animate({ count: endValue }, {
                duration: 1000,
                easing: "swing",
                step: function (now) {
                    $this.text(Math.ceil(now));
                }
            });
        });
    });
</script>
@endpush
