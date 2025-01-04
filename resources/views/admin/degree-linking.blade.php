@extends('layouts.admin')

@section('main')

<x-body-heading 
    heading="Degree to Programs Linking" 
    subheading="Link degrees of students to programs in which they can apply for admission." 
/>

<x-form-template 
    id="updateDegreeForm"
    method="PUT"
    route="degree.link" 
    routeid="{{ $degree->id }}"
    heading="Update Degree Programs" 
    subheading="Link programs to the selected degree here."
    button="Save Changes"
>

    <!-- Degree Details Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Degree Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Degree</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($degree)
                        <tr>
                            <td>{{ $degree->name }}</td>
                            <td>{{ $degree->type }}</td>
                            <td>
                                <span class="badge {{ $degree->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $degree->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3" class="text-center">
                                Degree not found.
                                <a href="{{ route('degree.create') }}" class="btn btn-sm btn-primary ms-2">
                                    Add Degree
                                </a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Programs Linking Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Link Programs</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach ($programs as $program)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input 
                                class="form-check-input border-dark @error('programs') is-invalid @enderror" 
                                type="checkbox" 
                                name="programs[]" 
                                id="program_{{ $program->id }}" 
                                value="{{ $program->id }}" 
                                {{ in_array($program->id, old('programs', $degree->programs->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="program_{{ $program->id }}">
                                {{ $program->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            @error('programs')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</x-form-template>

@endsection

@push('script')
<script>
    // Add any custom scripts for interactivity here
</script>
@endpush
