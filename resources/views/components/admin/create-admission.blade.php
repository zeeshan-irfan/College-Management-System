<x-form-template
    id="createAdmissionForm"
    method="POST"
    route="admission.store"
    heading="Start Admission"
    subheading="Initiate a new admission process with the required details."
    button="Start Admission">

    <!-- Semester Selection -->
    <div class="col-12">
        <div class="mb-4">
            <label for="semester" class="form-label text-primary-emphasis fw-semibold">Semester</label>
            <select
                class="form-select shadow-sm @error('semester') is-invalid @enderror"
                name="semester"
                id="semester"
                aria-invalid="{{ $errors->has('semester') ? 'true' : 'false' }}"
                required>
                <option value="" disabled {{ old('semester') ? '' : 'selected' }}>Select Semester</option>
                <option value="fall" {{ old('semester') == 'fall' ? 'selected' : '' }}>Fall</option>
                <option value="spring" {{ old('semester') == 'spring' ? 'selected' : '' }}>Spring</option>
                <option value="summer" {{ old('semester') == 'summer' ? 'selected' : '' }}>Summer</option>
            </select>
            @error('semester')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Batch Input -->
    <div class="col-12">
        <div class="mb-4">
            <label for="batch" class="form-label text-primary-emphasis fw-semibold">Batch Name</label>
            <input type="text"
                class="form-control shadow-sm @error('batch') is-invalid @enderror"
                placeholder="e.g., Fall 2025"
                name="batch"
                id="batch"
                value="{{ old('batch') ?? '' }}"
                required>
            @error('batch')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Last Date Input -->
    <div class="col-12">
        <div class="mb-4">
            <label for="last_date" class="form-label text-primary-emphasis fw-semibold">Last Date to Apply</label>
            <input type="date"
                class="form-control shadow-sm @error('last_date') is-invalid @enderror"
                name="last_date"
                id="last_date"
                value="{{ old('last_date') ?? '' }}"
                required>
            @error('last_date')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Challan Fee Input -->
    <div class="col-12">
        <div class="mb-4">
            <label for="challan_fee" class="form-label text-primary-emphasis fw-semibold">Admission Fee (Challan Fee)</label>
            <input type="number"
                class="form-control shadow-sm @error('challan_fee') is-invalid @enderror"
                placeholder="e.g., 1000"
                name="challan_fee"
                id="challan_fee"
                value="{{ old('challan_fee') ?? '' }}"
                required>
            @error('challan_fee')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Challan Last Date Input -->
    <div class="col-12">
        <div class="mb-4">
            <label for="challan_last_date" class="form-label text-primary-emphasis fw-semibold">Last Date to Submit Challan</label>
            <input type="date"
                class="form-control shadow-sm @error('challan_last_date') is-invalid @enderror"
                name="challan_last_date"
                id="challan_last_date"
                value="{{ old('challan_last_date') ?? '' }}"
                required>
            @error('challan_last_date')
                <div class="form-text invalid-feedback">{{ $message }}</div>
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
                        <option value="{{ $bank->id }}" {{ old('bank_id') == $bank->id ? 'selected' : '' }}>
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

    <!-- Information Section -->
    <div class="col-12 mb-3">
        <div class="alert alert-info border-info text-primary-emphasis" role="alert">
            <strong>Note:</strong> Admission will be available for all <strong>active programs</strong>. Ensure the programs are updated before proceeding.
        </div>
    </div>

</x-form-template>
