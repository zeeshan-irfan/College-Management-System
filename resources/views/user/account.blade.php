@extends('layouts.user')

@section('main')

    <x-body-heading heading="Account" subheading="Update name, password e.t.c from here."/>
    <x-user.update-password-form />

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
