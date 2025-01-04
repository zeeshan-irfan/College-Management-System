@extends('layouts.admin')

@section('main')

<x-body-heading heading="Banks" subheading="Manage all banks from here." />

<x-form-template
    id="editBankForm"
    method="PUT"
    route="bank.update"
    routeid="{{ $bank->id }}"
    heading="Edit Bank"
    subheading="Update bank details here."
    button="Update">

    {{-- Bank Name --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Bank Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="e.g., Bank Name"
                name="name"
                id="name"
                autocomplete="name"
                value="{{ old('name', $bank->name) }}"
                required>
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Bank Account --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="account" class="form-label text-light-emphasis">Bank Account Number</label>
            <input
                type="text"
                class="form-control @error('account') is-invalid @enderror"
                placeholder="Enter account number"
                name="account"
                id="account"
                value="{{ old('account', $bank->account) }}"
                required>
            @error('account')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Bank Logo --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="logo" class="form-label text-light-emphasis">Bank Logo</label>
            <input
                type="file"
                class="form-control @error('logo') is-invalid @enderror"
                name="logo"
                id="logo"
                accept=".jpg,.jpeg,.png">
            <small class="form-text text-muted">Accepted formats: jpg, jpeg, png.</small>
            @if ($bank->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $bank->logo) }}" alt="Bank Logo" class="img-thumbnail" width="120">
                    <p class="text-muted small">Current Logo</p>
                </div>
            @endif
            @error('logo')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</x-form-template>

@endsection

@push('script')
<!-- Additional JS, if needed -->
@endpush
