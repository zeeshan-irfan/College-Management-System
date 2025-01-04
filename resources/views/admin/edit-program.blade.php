@extends('layouts.admin')

@section('main')

<x-body-heading heading="programs" subheading="Manage all programs from here."/>




<x-form-template 
                id="updateProgramForm"
                method="PUT"
                route="program.update" 
                routeid="{{$program->id }}"
                heading="Update program" 
                subheading="Update program details here."
                button="Update">

    
                <div class="col-12">
                    <div class="mb-3">
                        <label for="department" class="form-label text-light-emphasis">Department</label>
                        <select 
                            class="form-control @error('department') is-invalid @enderror" 
                            name="department" 
                            id="department" 
                            aria-describedby="departmentHelp" 
                            required
                        >
                            <option value="" disabled selected>Select a department</option>
                            @foreach ($departments as $department)
                                <option 
                                    value="{{ $department->id }}" 
                                    {{ (old('department') == $department->id || $program->department_id == $department->id) ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="form-text invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                

    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full program Name</label>
            <input type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="eg., program of xxxxxxxxxxxxxx"
                    name="name" 
                    id="name" 
                    aria-describedby="name" 
                    autocomplete="name" 
                    value="{{ $program->name ?? old('name') ?? '' }}" 
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
                <option value="1" {{ (old('status', $program->status) == 1) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ (old('status', $program->status) == 0) ? 'selected' : '' }}>Inactive</option>
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