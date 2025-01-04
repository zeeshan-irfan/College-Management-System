@extends('layouts.user')

@section('main')

<div class="container-fluid bg-light py-5">
    <div class="text-center  mb-5">
        <h2 class="text-primary-emphasis fw-bold heading-line">Meet The Team</h2>
        <p class="text-secondary ">Discover some of the remarkable people who contributed to bring this project to life with dedication and expertise.</p>
    </div>
    <div class="container">
        <div class="row  justify-content-center">
            @forelse ($members as $member)
            <x-user.testimonial :member="$member" />
            @empty
                Nothing to show.
            @endforelse

        </div>
    </div>

</div>


@endsection

@push('script')

@endpush
