@extends('layouts.admin')

@section('main')

<x-body-heading heading="Degrees" subheading="Manage all degrees from here."/>

<x-form-template 
    id="updateDegreeForm"
    method="PUT"
    route="degree.update" 
    routeid="{{ $degree->id }}"
    heading="Update degree" 
    subheading="Update degree details here."
    button="Update">

    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Degree Name</label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   placeholder="e.g., Degree of xxxxxxxxxxxxxx"
                   name="name" 
                   id="name" 
                   autocomplete="name" 
                   value="{{ old('name', $degree->name) }}" 
                   required>
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="type" class="form-label text-light-emphasis">Select Type (Level)</label>
            <select 
                class="form-control @error('type') is-invalid @enderror" 
                name="type" 
                id="type" 
                required>
                <option value="" disabled {{ old('type', $degree->type) ? '' : 'selected' }}>Select a type</option>
                <option value="matric" {{ old('type', $degree->type) == 'Matric or Equivalent' ? 'selected' : '' }}>Matric or Equivalent</option>
                <option value="intermediate" {{ old('type', $degree->type) == 'Intermediate or Equivalent' ? 'selected' : '' }}>Intermediate or Equivalent</option>
                <option value="ba" {{ old('type', $degree->type) == 'BA/BSc or Equivalent' ? 'selected' : '' }}>BA/BSc or Equivalent</option>
                <option value="ma" {{ old('type', $degree->type) == 'MA/MSc / BS Hon\'s or Equivalent' ? 'selected' : '' }}>MA/MSc / BS Hon's or Equivalent</option>
            </select>
            @error('type')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

    <div class="col-12">
        <div class="mb-3">
            <label for="status" class="form-label text-light-emphasis">Active Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="1" {{ old('status', $degree->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $degree->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</x-form-template>

@endsection

@push('script')
<!-- Additional JS, if needed -->
@endpush
