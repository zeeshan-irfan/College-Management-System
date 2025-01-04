@extends('layouts.admin')

@section('main')

<x-body-heading heading="Download Applications" subheading="Download all admission applications from here." />

<!-- Form Template for Export -->
<x-form-template
    id="downloadApplicationsForm"
    method="GET"
    route="records.export"
    heading="Download Applications"
    subheading="Select filters to export the applications."
    button="Export Records"> <!-- Change button text to better reflect export action -->

    <!-- Admission Filter -->
    <div class="col-12">
        <div class="mb-3">
            <label for="admission" class="form-label text-light-emphasis">Select Admission</label>
            <select
                class="form-control @error('admission') is-invalid @enderror"
                name="admission"
                id="admission"
                aria-describedby="admissionHelp"
                required
            >
                <option value="" disabled selected>Select an Admission</option>
                @foreach ($admissions as $admission)
                    <option
                        value="{{ $admission->id }}"
                        {{ old('admission') == $admission->id ? 'selected' : '' }}
                    >
                        {{ $admission->semester.' - '.$admission->batch }}
                    </option>
                @endforeach
            </select>
            @error('admission')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Program Filter -->
    <div class="col-12">
        <div class="mb-3">
            <label for="program" class="form-label text-light-emphasis">Select Program</label>
            <select
                class="form-control @error('program') is-invalid @enderror"
                name="program"
                id="program"
                aria-describedby="programHelp"

            >
                <option value=""  selected>All (include all programs)</option>
                @foreach ($programs as $program)
                    <option
                        value="{{ $program->id }}"
                        {{ old('program') == $program->id ? 'selected' : '' }}
                    >
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
            @error('program')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        Note: This will export the selected applications as an Excel file based on the selected filters.
    </div>

</x-form-template>

<x-delete-modal type="Application" message="This will also remove data associated with this Application." />

@endsection

@push('script')
<script>
    // $(document).ready(function() {
    //     $('#downloadApplicationsForm').on('submit', function(event) {
    //         // Disable the submit button
    //         $('#actionButton').prop('disabled', true);

    //         // Show the spinner inside the button
    //         $('#actionButton').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
    //     });
    // });
</script>
@endpush
