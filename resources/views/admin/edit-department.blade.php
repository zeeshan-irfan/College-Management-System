@extends('layouts.admin')

@section('main')

<x-body-heading heading="Departments" subheading="Manage all departments from here."/>




<x-form-template 
                id="updateDepartmentForm"
                method="PUT"
                route="department.update" 
                routeid="{{$department->id }}"
                heading="Update department" 
                subheading="Update department details here."
                button="Update">

   

    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Department Name</label>
            <input type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="eg., Department of xxxxxxxxxxxxxx"
                    name="name" 
                    id="name" 
                    aria-describedby="name" 
                    autocomplete="name" 
                    value="{{ $department->name ?? old('name') ?? '' }}" 
                    required 
                    >
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="status" class="form-label text-light-emphasis">Active Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="1" {{ (old('status', $department->status) == 1) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ (old('status', $department->status) == 0) ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</x-form-template>

    
@endsection

@push('script')
    
@endpush