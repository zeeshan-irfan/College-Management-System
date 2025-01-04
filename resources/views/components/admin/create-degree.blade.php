<x-form-template
    id="createDegreeForm"
    method="POST"
    route="degree.store"
    heading="Create degree"
    subheading="Create a new degree here."
    button="Add">

    <div class="col-12">
        <div class="mb-3">
            <label for="type" class="form-label text-light-emphasis">Select Type (Level)</label>
            <select
                class="form-control @error('type') is-invalid @enderror"
                aria-invalid="{{ $errors->has('type') ? 'true' : 'false' }}"
                name="type"
                id="type"
                aria-describedby="typeHelp"
                required
            >
                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select a type</option>
                <option value="matric" {{ old('type') == 'matric' ? 'selected' : '' }}>Matric or Equivalent</option>
                <option value="intermediate" {{ old('type') == 'intermediate' ? 'selected' : '' }}>Intermediate or Equivalent</option>
                <option value="ba" {{ old('type') == 'ba' ? 'selected' : '' }}>BA/BSc or Equivalent</option>
                <option value="ma" {{ old('type') == 'ma' ? 'selected' : '' }}>MA/MSc / BS Hon's or Equivalent</option>
            </select>
            @error('type')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Degree Name</label>
            <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                placeholder="eg., Matric Science, FSC Pre-Eng, BA Maths, etc."
                name="name"
                id="name"
                aria-describedby="name"
                autocomplete="name"
                value="{{ old('name') ?? '' }}"
                required
            >
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>



</x-form-template>
