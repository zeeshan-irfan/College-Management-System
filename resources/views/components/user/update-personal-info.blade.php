<x-form-template 
                id="updatePersonalInfoForm"
                method="PUT"
                route="updatePersonalInfo" 
                heading="Personal Information" 
                subheading="Update your personal information here.">

   

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Name</label>
            <input type="text" 
                    class="form-control text-muted @error('name') is-invalid @enderror" 
                    name="name" 
                    id="name" 
                     aria-describedby="name" 
                    autocomplete="name" 
                    value="{{ old('name') ?? Auth::user()->name ?? '' }}" 
                    required 
                    readonly>
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
                
    

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="cnic" class="form-label text-light-emphasis">CNIC</label>
            <input type="number" 
                   class="form-control @error('cnic') is-invalid @enderror" 
                   name="cnic" 
                   id="cnic" 
                   aria-describedby="cnic" 
                   autocomplete="off" 
                   pattern="^\d{14}$" 
                   minlength="13" maxlength="13"
                   placeholder="e.g., 38xxxxxxxxxxx"
                   title="CNIC must be exactly 14 digits"
                   value="{{ old('cnic') ?? Auth::user()->personalinfo->cnic ?? '' }}" 
                   required>
            @error('cnic')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="nationality" class="form-label text-light-emphasis">Nationality</label>
            <input type="text" placeholder="e.g., Pakistani" class="form-control @error('nationality') is-invalid @enderror" name="nationality" id="nationality" aria-describedby="nationality" autocomplete="nationality" value="{{ old('nationality') ?? Auth::user()->personalinfo->nationality ?? '' }}" required>
            @error('nationality')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="gender" class="form-label text-light-emphasis">Gender</label>
            <select class="form-control @error('gender') is-invalid @enderror" 
                    name="gender" 
                    id="gender" 
                    aria-describedby="gender" 
                    required>
                <option value="">Select Gender</option>
                <option value="Male" {{ (old('gender') ?? Auth::user()->personalinfo->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ (old('gender') ?? Auth::user()->personalinfo->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ (old('gender') ?? Auth::user()->personalinfo->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="dob" class="form-label text-light-emphasis">Date of Birth</label>
            <input type="date" 
                   class="form-control @error('dob') is-invalid @enderror" 
                   name="dob" 
                   id="dob" 
                   aria-describedby="dob" 
                   autocomplete="bday" 
                   value="{{ old('dob') ?? Auth::user()->personalinfo->dob ?? '' }}" 
                   required>
            @error('dob')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="pob" class="form-label text-light-emphasis">Place of Birth</label>
            <input type="text" 
                   placeholder="e.g., Islamabad" 
                   class="form-control @error('pob') is-invalid @enderror" 
                   name="pob" 
                   id="pob" 
                   aria-describedby="pob" 
                   autocomplete="off" 
                   value="{{ old('pob') ?? Auth::user()->personalinfo->pob ?? '' }}" 
                   required>
            @error('pob')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="domicileDist" class="form-label text-light-emphasis">Domicile District</label>
            <input type="text" 
                   placeholder="e.g., Lahore" 
                   class="form-control @error('domicileDist') is-invalid @enderror" 
                   name="domicileDist" 
                   id="domicileDist" 
                   aria-describedby="domicileDist" 
                   autocomplete="off" 
                   value="{{ old('domicileDist') ?? Auth::user()->personalinfo->domicileDist ?? '' }}" 
                   required>
            @error('domicileDist')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="domicileProvince" class="form-label text-light-emphasis">Domicile Province</label>
            <input type="text" 
                   placeholder="e.g., Punjab" 
                   class="form-control @error('domicileProvince') is-invalid @enderror" 
                   name="domicileProvince" 
                   id="domicileProvince" 
                   aria-describedby="domicileProvince" 
                   autocomplete="off" 
                   value="{{ old('domicileProvince') ?? Auth::user()->personalinfo->domicileProvince ?? '' }}" 
                   required>
            @error('domicileProvince')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="religion" class="form-label text-light-emphasis">Religion</label>
            <select class="form-control @error('religion') is-invalid @enderror" 
                    name="religion" 
                    id="religion" 
                    aria-describedby="religion" 
                    required>
                <option value="">Select religion</option>
                <option value="Islam" 
                        {{ (old('religion') ?? Auth::user()->personalinfo->religion ?? '') == 'Islam' ? 'selected' : '' }}>
                    Islam
                </option>
                <option value="Christianity" 
                        {{ (old('religion') ?? Auth::user()->personalinfo->religion ?? '') == 'Christianity' ? 'selected' : '' }}>
                    Christianity
                </option>
                
                <option value="Other" 
                        {{ (old('religion') ?? Auth::user()->personalinfo->religion ?? '') == 'Other' ? 'selected' : '' }}>
                    Other
                </option>
            </select>
            @error('religion')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="contact" class="form-label text-light-emphasis">Cell no</label>
            <input type="tel" 
                   class="form-control @error('contact') is-invalid @enderror" 
                   name="contact" 
                   id="contact" 
                   aria-describedby="contact" 
                   autocomplete="tel" 
                   placeholder="e.g., +1234567890" 
                   pattern="^\+?[0-9]{10,15}$" 
                   value="{{ old('contact') ?? Auth::user()->personalinfo->contact ?? '' }}" 
                   required>
            @error('contact')
            <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    

</x-form-template>