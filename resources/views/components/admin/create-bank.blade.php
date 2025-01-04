<x-form-template
    id="createBankForm"
    method="POST"
    route="bank.store"
    heading="Create Bank"
    subheading="Register a new bank in the system."
    button="Add Bank">

    <!-- Bank Name -->

    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Bank Name</label>
            <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                placeholder="e.g., National Bank of Pakistan"
                name="name"
                id="name"
                aria-describedby="nameHelp"
                autocomplete="name"
                value="{{ old('name') ?? '' }}"
                required
            >
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Bank Logo -->
    <div class="col-12">
        <div class="mb-3">
            <label for="logo" class="form-label text-light-emphasis">Bank Logo</label>
            <input type="file"
                class="form-control @error('logo') is-invalid @enderror"
                aria-invalid="{{ $errors->has('logo') ? 'true' : 'false' }}"
                name="logo"
                id="logo"
                accept=".jpg,.jpeg,.png"
                aria-describedby="logoHelp"
            >
            <small id="logoHelp" class="form-text text-muted">Upload a logo (only jpg, jpeg, or png formats allowed).</small>
            @error('logo')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Bank Account Number -->
    <div class="col-12">
        <div class="mb-3">
            <label for="account" class="form-label text-light-emphasis">Bank Account Number</label>
            <input type="text"
                class="form-control @error('account') is-invalid @enderror"
                aria-invalid="{{ $errors->has('account') ? 'true' : 'false' }}"
                placeholder="e.g., 1234567890123456"
                name="account"
                id="account"
                aria-describedby="accountHelp"
                value="{{ old('account') ?? '' }}"
                maxlength="30"
                required
            >
            <small id="accountHelp" class="form-text text-muted">Enter the bank's account number (max 30 characters).</small>
            @error('account')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</x-form-template>
