<x-form-template id="updateAddressForm" 
                method="PUT"
                 route="updateAddress" 
                 heading="Address Information" 
                 subheading="Update your address and contact info here.">


    <div class="col-12">
        <div class="mb-3">
            <label for="line" class="form-label text-light-emphasis">Address Line</label>
            <textarea class="form-control @error('line') is-invalid @enderror" placeholder="Type here" name="line" id="line" required>{{ old('line') ?? Auth::user()->address->line ?? '' }}</textarea>
            @error('line')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="city" class="form-label text-light-emphasis">City</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" aria-describedby="city" autocomplete="no" value="{{ old('city') ?? Auth::user()->address->city ?? '' }}" required>
            @error('city')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="province" class="form-label text-light-emphasis">State/Province</label>
            <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" id="province" aria-describedby="province" autocomplete="province" value="{{ old('province') ?? Auth::user()->address->province ?? '' }}" required>
            @error('province')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="country" class="form-label text-light-emphasis">Country</label>
            <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" id="country" aria-describedby="country" autocomplete="country-name" value="{{ old('country') ?? Auth::user()->address->country ?? '' }}" required>
            @error('country')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="contact" class="form-label text-light-emphasis">Contact</label>
            <input type="tel" 
                   class="form-control @error('contact') is-invalid @enderror" 
                   name="contact" 
                   id="contact" 
                   aria-describedby="contact" 
                   autocomplete="tel" 
                   placeholder="e.g., +1234567890" 
                   pattern="^\+?[0-9]{10,15}$" 
                   value="{{ old('contact') ?? Auth::user()->address->contact ?? '' }}" 
                   required>
            @error('contact')
            <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

</x-form-template>