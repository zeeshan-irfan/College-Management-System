@extends('layouts.admin')

@section('main')

<x-body-heading heading="Admissions" subheading="Manage and update admission details from here." />

<x-form-template
    id="updateAdmissionForm"
    method="PUT"
    route="admission.update"
    routeid="{{ $admission->id }}"
    heading="Update Admission"
    subheading="Update the details of this admission here."
    button="Update">

    <!-- Semester Selection -->
    <div class="col-12">
        <div class="mb-3">
            <label for="semester" class="form-label text-light-emphasis">Select Semester</label>
            <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                <option value="fall" {{ old('semester', $admission->semester) == 'fall' ? 'selected' : '' }}>Fall</option>
                <option value="spring" {{ old('semester', $admission->semester) == 'spring' ? 'selected' : '' }}>Spring</option>
                <option value="summer" {{ old('semester', $admission->semester) == 'summer' ? 'selected' : '' }}>Summer</option>
            </select>
            @error('semester')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Batch Name -->
    <div class="col-12">
        <div class="mb-3">
            <label for="batch" class="form-label text-light-emphasis">Full Batch Name</label>
            <input type="text"
                   class="form-control @error('batch') is-invalid @enderror"
                   placeholder="e.g., Fall 2025"
                   name="batch"
                   id="batch"
                   value="{{ old('batch', $admission->batch) }}"
                   required
                   aria-label="Full Batch Name">
            @error('batch')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Last Date to Apply -->
    <div class="col-12">
        <div class="mb-3">
            <label for="last_date" class="form-label text-light-emphasis">Last Date to Apply</label>
            <input type="date"
                   class="form-control @error('last_date') is-invalid @enderror"
                   name="last_date"
                   id="last_date"
                   value="{{ old('last_date', $admission->last_date ? $admission->last_date->toDateString() : '') }}"
                   required
                   aria-label="Last Date to Apply">
            @error('last_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Challan Fee -->
    <div class="col-12">
        <div class="mb-3">
            <label for="challan_fee" class="form-label text-light-emphasis">Admission Fee (Challan Fee)</label>
            <input type="number"
                   class="form-control @error('challan_fee') is-invalid @enderror"
                   placeholder="e.g., 1000"
                   name="challan_fee"
                   id="challan_fee"
                   value="{{ old('challan_fee', $admission->challan_fee) }}"
                   required
                   step="any"
                   aria-label="Admission Fee (Challan Fee)">
            @error('challan_fee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Challan Last Date -->
    <div class="col-12">
        <div class="mb-3">
            <label for="challan_last_date" class="form-label text-light-emphasis">Challan Last Date</label>
            <input type="date"
                   class="form-control @error('challan_last_date') is-invalid @enderror"
                   name="challan_last_date"
                   id="challan_last_date"
                   value="{{ old('challan_last_date', $admission->challan_last_date ? $admission->challan_last_date->toDateString() : '') }}"
                   required
                   aria-label="Challan Last Date">
            @error('challan_last_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Select Bank -->
    <div class="col-12">
        <div class="mb-3">
            <label for="bank_id" class="form-label text-light-emphasis">Select Bank</label>
            <select name="bank_id" id="bank_id" class="form-control @error('bank_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a bank</option>
                @if($banks->isEmpty())
                    <option disabled>No banks available. Please add a bank first.</option>
                @else
                    @foreach($banks as $bank)
                        <option value="{{ $bank->id }}" {{ old('bank_id', $admission->bank_id) == $bank->id ? 'selected' : '' }}>
                            {{ $bank->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('bank_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Status Selection -->
    <div class="col-12">
        <div class="mb-3">
            <label for="status" class="form-label text-light-emphasis">Admission Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="1" {{ old('status', $admission->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $admission->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</x-form-template>

@endsection

@push('script')

@endpush
