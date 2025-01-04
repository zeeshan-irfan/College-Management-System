<x-form-template
                id="updateMatricForm"
                method="PUT"
                route="updateMatricEducation"
                heading="Academic Record (A)"
                subheading="Update your Matric education details here.">


                 <div class="col-12">
                    <h6 class="text-primary-emphasis text-center heading-line">Matric or Equivalent</h6>
                 </div>

    {{-- Matric Starts --}}
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mdegree" class="form-label text-light-emphasis">Degree</label>
                    <select
                        class="form-control @error('mdegree') is-invalid @enderror"
                        name="mdegree"
                        id="mdegree"
                        aria-describedby="mdegree"
                        required
                    >
                        <option value="">Select Degree</option>
                        @if ($degrees->isNotEmpty())
                            @foreach ($degrees as $degree)
                                <option
                                    value="{{ $degree->id }}"
                                    {{ (old('mdegree') ?? optional(Auth::user()->matriceducation)->degree_id ?? '') === $degree->id ? 'selected' : '' }}
                                >
                                    {{ $degree->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>No degrees available</option>
                        @endif
                    </select>
                    @error('mdegree')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>






            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mboard" class="form-label text-light-emphasis">Board</label>
                    <input type="text"
                            class="form-control  @error('mboard') is-invalid @enderror"
                            name="mboard"
                            id="mboard"
                            aria-describedby="mboard"
                            autocomplete="no"
                            value="{{ old('mboard') ?? Auth::user()->matriceducation->mboard ?? '' }}"
                            required>
                    @error('mboard')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="minstitute" class="form-label text-light-emphasis">Name of Institution</label>
                    <input type="text"
                            class="form-control  @error('minstitute') is-invalid @enderror"
                            name="minstitute"
                            id="minstitute"
                            aria-describedby="minstitute"
                            autocomplete="no"
                            value="{{ old('minstitute') ?? Auth::user()->matriceducation->minstitute ?? '' }}"
                            required>
                    @error('minstitute')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="myear" class="form-label text-light-emphasis">Passing year</label>
                    <input
                        type="number"
                        class="form-control  @error('myear') is-invalid @enderror"
                        name="myear"
                        id="myear"
                        aria-describedby="myear"
                        autocomplete="off"
                        value="{{ old('myear') ?? Auth::user()->matriceducation->myear ?? '' }}"
                        min="1900" max="2080"
                        required
                    >
                    @error('myear')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mexam" class="form-label text-light-emphasis">Annual/Supplementary</label>
                    <select
                        class="form-control @error('mexam') is-invalid @enderror"
                        name="mexam"
                        id="mexam"
                        aria-describedby="mexam"
                        required
                    >
                        <option value="">Select Exam Type</option>
                        <option value="Annual" {{ (old('mexam') ?? Auth::user()->matriceducation->mexam ?? '') === 'Annual' ? 'selected' : '' }}>Annual</option>
                        <option value="Supplementary" {{ (old('mexam') ?? Auth::user()->matriceducation->mexam ?? '') === 'Supplementary' ? 'selected' : '' }}>Supplementary</option>
                    </select>
                    @error('mexam')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mroll" class="form-label text-light-emphasis">Roll No</label>
                    <input type="text"
                        class="form-control  @error('mroll') is-invalid @enderror"
                        name="mroll"
                        id="mroll"
                        aria-describedby="mroll"
                        autocomplete="off"
                        value="{{ old('mroll') ?? Auth::user()->matriceducation->mroll ?? '' }}"
                        required>
                    @error('mroll')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mtotal" class="form-label text-light-emphasis">Total Marks</label>
                    <input type="number"
                        class="form-control  @error('mtotal') is-invalid @enderror"
                        name="mtotal"
                        id="mtotal"
                        aria-describedby="mtotal"
                        autocomplete="off"
                        value="{{ old('mtotal') ?? Auth::user()->matriceducation->mtotal ?? '' }}"
                        placeholder="e.g., 1100"
                        required>
                    @error('mtotal')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mobtained" class="form-label text-light-emphasis">Obtained Marks</label>
                    <input type="number"
                        class="form-control  @error('mobtained') is-invalid @enderror"
                        name="mobtained"
                        id="mobtained"
                        aria-describedby="mobtained"
                        autocomplete="off"
                        value="{{ old('mobtained') ?? Auth::user()->matriceducation->mobtained ?? '' }}"
                        placeholder="e.g., 771"
                        required>
                    @error('mobtained')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mpercent" class="form-label text-light-emphasis">Percentage %</label>
                    <input type="number"
                        class="form-control  @error('mpercent') is-invalid @enderror"
                        name="mpercent"
                        id="mpercent"
                        aria-describedby="mpercent"
                        autocomplete="off"
                        value="{{ old('mpercent') ?? Auth::user()->matriceducation->mpercent ?? '' }}"
                        placeholder="e.g., 85"
                        min="0"
                        max="100"
                        step="0.01"
                        required>
                    @error('mpercent')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="mgrade" class="form-label text-light-emphasis">Grade/Division</label>
                    <select
                        class="form-control @error('mgrade') is-invalid @enderror"
                        name="mgrade"
                        id="mgrade"
                        aria-describedby="mgrade"
                        required
                    >
                        <option value="">Select Grade/Division</option>
                        <option value="A" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'E' ? 'selected' : '' }}>E</option>
                        <option value="F" {{ (old('mgrade') ?? Auth::user()->matriceducation->mgrade ?? '') === 'F' ? 'selected' : '' }}>F</option>
                    </select>
                    @error('mgrade')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Matric Ends --}}


</x-form-template>
