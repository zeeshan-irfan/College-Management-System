@extends('layouts.user')

@section('main')

<x-body-heading heading="Profile" subheading="View and update your profile here."/>

<div class="container my-3 p-3 bg-light rounded-3 shadow">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class=""><i class="bi bi-person-fill-gear"></i> {{ Auth::user()->name }}'s profile</h3>
            <small class="text-secondary">Complete your profile upto 70% to apply for admissions.</small>
            <x-user.profile-percentage />
        </div>
    </div>
</div>




<x-user.update-name-image />
<x-user.update-personal-info />
<x-user.update-father />
<x-user.update-address />
<x-user.update-hafiz />
<x-user.update-disable />
<x-user.update-matric-education/>
<x-user.update-inter-education />
<x-user.update-ba-education />
<x-user.update-bs-education />






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

    // Target the 'name' input field for validation
    $('#updateNameImageForm #name').on('input', function() {
        var nameValue = $(this).val();
        var nameError = $('#name').next('.invalid-feedback'); // Find the error message

        // Check if the name field is empty or has invalid characters (for example, non-alphabetic)
        if (nameValue.trim() === '') {
            // Display error message
            if (!nameError.length) {
                $(this).after('<div class="form-text invalid-feedback">Name is required.</div>');
            }
            $(this).addClass('is-invalid'); // Add invalid class
        } else if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
            // Check for alphabetic characters only
            if (!nameError.length) {
                $(this).after('<div class="form-text invalid-feedback">Name can only contain letters and spaces.</div>');
            }
            $(this).addClass('is-invalid'); // Add invalid class
        } else {
            // Valid name input
            $(this).removeClass('is-invalid'); // Remove invalid class
            $(this).next('.invalid-feedback').remove(); // Remove the error message
        }
    });

    // General function for form validation
    function validateForm(formId) {
        let isValid = true;
        let form = $(formId);

        // Reset previous error styles
        form.find('input, select').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        // Validate required fields
        form.find('input, select').each(function() {
            let $field = $(this);

              // Ignore fields with name 'gname' and 'grelation'
                if ($field.attr('name') === 'gname' || $field.attr('name') === 'grelation') {
                    return; // Skip to the next iteration
                }

            if ($field.val().trim() === "") {
                isValid = false;
                $field.addClass('is-invalid');
                $field.after('<div class="invalid-feedback">This field is required.</div>');
            }
        });

        // Validate numerical fields (Total Marks, Obtained Marks, Passing Year, Percentage)
        form.find('input[type="number"]').each(function() {
            let $field = $(this);
            let value = parseFloat($field.val());
            let min = $field.attr('min') ? parseFloat($field.attr('min')) : -Infinity;
            let max = $field.attr('max') ? parseFloat($field.attr('max')) : Infinity;

            if (isNaN(value) || value < min || value > max) {
                isValid = false;
                $field.addClass('is-invalid');
                $field.after(`<div class="invalid-feedback">Please enter a valid number.</div>`);
            }
        });

        // Validate "Obtained Marks" should not exceed "Total Marks"
        form.find('.mtotal, .itotal, .batotal, .bstotal').each(function() {
            let totalMarks = parseFloat($(this).val());
            let obtainedMarks = parseFloat(form.find('.mobtained, .iobtained, .baobtained, .bsobtained').val());

            if (obtainedMarks > totalMarks) {
                isValid = false;
                form.find('.mobtained, .iobtained, .baobtained, .bsobtained').addClass('is-invalid');
                form.find('.mobtained, .iobtained, .baobtained, .bsobtained').after('<div class="invalid-feedback">Obtained marks cannot be greater than total marks.</div>');
            }
        });

        // If form is invalid, prevent submission
        if (!isValid) {
            form.find('button[type="submit"]').prop('disabled', false); // Enable submit button if validation fails
            return false;
        }
        return true;
    }

    // Bind form submission with validation
    $('#updatePersonalInfoForm, #updatefatherInfoForm, #updateAddressForm, #updateMatricForm, #updateInterForm, #updateBaForm,#updateBsForm').on('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting initially

        var formId = $(this).attr('id');  // Get the ID of the form being submitted

        if (validateForm('#' + formId)) {  // Validate the correct form
            $(this).off('submit').submit();  // Submit the form if valid
        }
    });


   // Dynamic validation on field input (especially for Total Marks and Obtained Marks)
   $('#mtotal, #mobtained, #itotal, #iobtained, #batotal, #baobtained, #bstotal, #bsobtained').on('input', function() {
        let form = $(this).closest('form');

        let totalMarks, obtainedMarks;

        // Identifying which form and validating the fields accordingly
        if (form.is('#updateMatricForm')) {
            totalMarks = parseFloat(form.find('#mtotal').val());
            obtainedMarks = parseFloat(form.find('#mobtained').val());
        } else if (form.is('#updateInterForm')) {
            totalMarks = parseFloat(form.find('#itotal').val());
            obtainedMarks = parseFloat(form.find('#iobtained').val());
        } else if (form.is('#updateBaForm')) {
            totalMarks = parseFloat(form.find('#batotal').val());
            obtainedMarks = parseFloat(form.find('#baobtained').val());
        } else if (form.is('#updateBsForm')) {
            totalMarks = parseFloat(form.find('#bstotal').val());
            obtainedMarks = parseFloat(form.find('#bsobtained').val());
        }

        // Check if Obtained Marks exceed Total Marks
        if (obtainedMarks > totalMarks) {
            form.find('#mobtained, #iobtained, #baobtained, #bsobtained').addClass('is-invalid');
            if (!form.find('#mobtained, #iobtained, #baobtained, #bsobtained').next('.invalid-feedback').length) {
                form.find('#mobtained, #iobtained, #baobtained, #bsobtained').after('<div class="invalid-feedback">Obtained marks cannot be greater than total marks.</div>');
            }
        } else {
            form.find('#mobtained, #iobtained, #baobtained, #bsobtained').removeClass('is-invalid');
            form.find('#mobtained, #iobtained, #baobtained, #bsobtained').next('.invalid-feedback').remove();
        }
    });
});


$('#updateHafizInfoForm').on('submit', function(event) {
        event.preventDefault(); // Prevent form submission initially
        let isValid = validateHafizSelection(); // Run validation function

        if (isValid) {
            $(this).off('submit').submit(); // Submit the form if valid
        }
    });

    // Real-time validation when radio selection changes
    $('input[name="hafiz"]').on('change', function() {
        validateHafizSelection();
    });

    // Validation function for Hafiz selection
    function validateHafizSelection() {
        let isSelected = $('input[name="hafiz"]:checked').length > 0;

        if (isSelected) {
            $('input[name="hafiz"]').removeClass('is-invalid');
            $('#hafizError').remove();
        } else {
            // Add error styling and message if no selection
            $('input[name="hafiz"]').addClass('is-invalid');

            if (!$('#hafizError').length) {
                // Insert error message after the label if not already present
                $('label[for="hafiz1"]').first().after('<div id="hafizError" class="invalid-feedback d-block">Please select an option.</div>');
            }
        }
        return isSelected;
    }

     // Validate on form submit for the disability form
     $('#updateDisableInfoForm').on('submit', function(event) {
        event.preventDefault(); // Prevent form submission initially
        let isValid = validateDisableSelection(); // Run validation function

        if (isValid) {
            $(this).off('submit').submit(); // Submit the form if valid
        }
    });

    // Real-time validation when radio selection changes
    $('input[name="disabled"]').on('change', function() {
        validateDisableSelection();
    });

    // Validation function for disability selection
    function validateDisableSelection() {
        let isSelected = $('input[name="disabled"]:checked').length > 0;

        if (isSelected) {
            $('input[name="disabled"]').removeClass('is-invalid');
            $('#disableError').remove();
        } else {
            // Add error styling and message if no selection
            $('input[name="disabled"]').addClass('is-invalid');

            if (!$('#disableError').length) {
                // Insert error message after the label if not already present
                $('label[for="disabled1"]').first().after('<div id="disableError" class="invalid-feedback d-block">Please select an option.</div>');
            }
        }
        return isSelected;
    }

</script>

@endpush
