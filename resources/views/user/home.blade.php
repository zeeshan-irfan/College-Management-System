@extends('layouts.user')

@section('main')


<x-body-heading heading="Home" subheading="View your overall profile."/>

<x-admission-notification/>





<div class="container-fluid mb-3">
    <div class="row">
        @auth
        <x-home-card icon="check-circle" icolor="success" count="{{count(Auth::user()->records)}}" sign="Total" heading="Applications" subheading="applied" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($departmentsCount) ? $departmentsCount : 0 }}" sign="Total" heading="Departments" subheading="established" />
        <x-home-card icon="check-circle" icolor="success" count="{{ isset($programsCount) ? $programsCount : 0 }}" sign="Total" heading="Programs" subheading="offered" />
        @endauth


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
