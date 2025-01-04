@extends('layouts.admin')

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

<x-admin.create-about />

<x-delete-modal type="Member" message="This will also remove all data associated with this Member."/>


@endsection

@push('script')

<script>
$(document).ready(function() {
    $('#image').on('change', function(event) {
        const file = this.files[0];
        const maxSize = 1 * 1024 * 1024; // 1 MB in bytes
        const $imageError = $('#imageError');
        const $imageDisplay = $('#imageDisplay');

        // Validate file size
        if (file && file.size > maxSize) {
            $imageError.removeClass('d-none').text("File size must be less than 1MB.");
            $(this).val(''); // Clear the file input
            $imageDisplay.attr('src', '{{ asset("storage/images/logo/person.png") }}'); // Reset to default image
        } else {
            $imageError.addClass('d-none').text(''); // Hide error message if size is valid

            // Show preview of the image
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $imageDisplay.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        }
    });

});

</script>
@endpush
