<x-form-template
                id="updateBsForm"
                method="PUT"
                route="updateBsEducation"
                heading="Academic Record (D)"
                subheading="Update your MA/MSc / BS Hon's or equivalent education details here.">

    <div class="col-12 my-3 text-center">
        <h6 class="mb-0 text-primary-emphasis heading-line text-center">MA/MSc / BS Hon's or Equivalent (Optional )</h6>
        <small class="mb-0 text-danger text-center">Only add this portion if you have the required degree, otherwise skip this part</small>
    </div>


    {{-- Intermediate Starts --}}
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsdegree" class="form-label text-light-emphasis">Degree</label>
                    <select
                        class="form-control @error('bsdegree') is-invalid @enderror"
                        name="bsdegree"
                        id="bsdegree"
                        aria-describedby="bsdegree"
                        required
                    >
                        <option value="">Select Degree</option>
                        @if ($degrees->isNotEmpty())
                            @foreach ($degrees as $degree)
                                <option
                                    value="{{ $degree->id }}"
                                    {{ (old('bsdegree') ?? optional(Auth::user()->bseducation)->degree_id ?? '') === $degree->id ? 'selected' : '' }}
                                >
                                    {{ $degree->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>No degrees available</option>
                        @endif
                    </select>
                    @error('bsdegree')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsboard" class="form-label text-light-emphasis">Board</label>
                    <input type="text"
                            class="form-control  @error('bsboard') is-invalid @enderror"
                            name="bsboard"
                            id="bsboard"
                            aria-describedby="bsboard"
                            autocomplete="no"
                            value="{{ old('bsboard') ?? Auth::user()->bseducation->bsboard ?? '' }}"
                            required>
                    @error('bsboard')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsinstitute" class="form-label text-light-emphasis">Name of Institution</label>
                    <input type="text"
                            class="form-control  @error('bsinstitute') is-invalid @enderror"
                            name="bsinstitute"
                            id="bsinstitute"
                            aria-describedby="bsinstitute"
                            autocomplete="no"
                            value="{{ old('bsinstitute') ?? Auth::user()->bseducation->bsinstitute ?? '' }}"
                            required>
                    @error('bsinstitute')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsyear" class="form-label text-light-emphasis">Passing year</label>
                    <input
                        type="number"
                        class="form-control  @error('bsyear') is-invalid @enderror"
                        name="bsyear"
                        id="bsyear"
                        aria-describedby="bsyear"
                        autocomplete="off"
                        value="{{ old('bsyear') ?? Auth::user()->bseducation->bsyear ?? '' }}"
                        min="1900" max="2080"
                        required
                    >
                    @error('bsyear')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsexam" class="form-label text-light-emphasis">Annual/Supplementary</label>
                    <select
                        class="form-control @error('bsexam') is-invalid @enderror"
                        name="bsexam"
                        id="bsexam"
                        aria-describedby="bsexam"
                        required
                    >
                        <option value="">Select Exam Type</option>
                        <option value="Annual" {{ (old('bsexam') ?? Auth::user()->bseducation->bsexam ?? '') === 'Annual' ? 'selected' : '' }}>Annual</option>
                        <option value="Supplementary" {{ (old('bsexam') ?? Auth::user()->bseducation->bsexam ?? '') === 'Supplementary' ? 'selected' : '' }}>Supplementary</option>
                    </select>
                    @error('bsexam')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsroll" class="form-label text-light-emphasis">Roll No</label>
                    <input type="text"
                        class="form-control  @error('bsroll') is-invalid @enderror"
                        name="bsroll"
                        id="bsroll"
                        aria-describedby="bsroll"
                        autocomplete="off"
                        value="{{ old('bsroll') ?? Auth::user()->bseducation->bsroll ?? '' }}"
                        required>
                    @error('bsroll')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bstotal" class="form-label text-light-emphasis">Total Marks</label>
                    <input type="number"
                        class="form-control  @error('bstotal') is-invalid @enderror"
                        name="bstotal"
                        id="bstotal"
                        aria-describedby="bstotal"
                        autocomplete="off"
                        value="{{ old('bstotal') ?? Auth::user()->bseducation->bstotal ?? '' }}"
                        placeholder="e.g., 1100"
                        required>
                    @error('bstotal')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsobtained" class="form-label text-light-emphasis">Obtained Marks</label>
                    <input type="number"
                        class="form-control  @error('bsobtained') is-invalid @enderror"
                        name="bsobtained"
                        id="bsobtained"
                        aria-describedby="bsobtained"
                        autocomplete="off"
                        value="{{ old('bsobtained') ?? Auth::user()->bseducation->bsobtained ?? '' }}"
                        placeholder="e.g., 771"
                        required>
                    @error('bsobtained')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bspercent" class="form-label text-light-emphasis">Percentage %</label>
                    <input type="number"
                        class="form-control  @error('bspercent') is-invalid @enderror"
                        name="bspercent"
                        id="bspercent"
                        aria-describedby="bspercent"
                        autocomplete="off"
                        value="{{ old('bspercent') ?? Auth::user()->bseducation->bspercent ?? '' }}"
                        placeholder="e.g., 85"
                        min="0"
                        max="100"
                        step="0.01"
                        required>
                    @error('bspercent')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bsgrade" class="form-label text-light-emphasis">Grade/Division</label>
                    <select
                        class="form-control @error('bsgrade') is-invalid @enderror"
                        name="bsgrade"
                        id="bsgrade"
                        aria-describedby="bsgrade"
                        required
                    >
                        <option value="">Select Grade/Division</option>
                        <option value="A" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'E' ? 'selected' : '' }}>E</option>
                        <option value="F" {{ (old('bsgrade') ?? Auth::user()->bseducation->bsgrade ?? '') === 'F' ? 'selected' : '' }}>F</option>
                    </select>
                    @error('bsgrade')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Intermediate Ends --}}

</x-form-template>
