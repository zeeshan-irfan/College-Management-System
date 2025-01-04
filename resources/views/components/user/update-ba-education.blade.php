<x-form-template
                id="updateBaForm"
                method="PUT"
                route="updateBaEducation"
                heading="Academic Record (C)"
                subheading="Update your BA/BSC or equivalent education details here.">

    <div class="col-12 my-3 text-center">
        <h6 class="mb-0 text-primary-emphasis heading-line text-center">BA/BSC or Equivalent (Optional )</h6>
        <small class="mb-0 text-danger text-center">Only add this portion if you have the required degree, otherwise skip this part</small>
    </div>


    {{-- Intermediate Starts --}}
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="badegree" class="form-label text-light-emphasis">Degree</label>
                    <select
                        class="form-control @error('badegree') is-invalid @enderror"
                        name="badegree"
                        id="badegree"
                        aria-describedby="badegree"
                        required
                    >
                        <option value="">Select Degree</option>
                        @if ($degrees->isNotEmpty())
                            @foreach ($degrees as $degree)
                                <option
                                    value="{{ $degree->id }}"
                                    {{ (old('badegree') ?? optional(Auth::user()->baeducation)->degree_id ?? '') === $degree->id ? 'selected' : '' }}
                                >
                                    {{ $degree->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>No degrees available</option>
                        @endif
                    </select>
                    @error('badegree')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="baboard" class="form-label text-light-emphasis">Board</label>
                    <input type="text"
                            class="form-control  @error('baboard') is-invalid @enderror"
                            name="baboard"
                            id="baboard"
                            aria-describedby="baboard"
                            autocomplete="no"
                            value="{{ old('baboard') ?? Auth::user()->baeducation->baboard ?? '' }}"
                            required>
                    @error('baboard')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bainstitute" class="form-label text-light-emphasis">Name of Institution</label>
                    <input type="text"
                            class="form-control  @error('bainstitute') is-invalid @enderror"
                            name="bainstitute"
                            id="bainstitute"
                            aria-describedby="bainstitute"
                            autocomplete="no"
                            value="{{ old('bainstitute') ?? Auth::user()->baeducation->bainstitute ?? '' }}"
                            required>
                    @error('bainstitute')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bayear" class="form-label text-light-emphasis">Passing year</label>
                    <input
                        type="number"
                        class="form-control  @error('bayear') is-invalid @enderror"
                        name="bayear"
                        id="bayear"
                        aria-describedby="bayear"
                        autocomplete="off"
                        value="{{ old('bayear') ?? Auth::user()->baeducation->bayear ?? '' }}"
                        min="1900" max="2080"
                        required
                    >
                    @error('bayear')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="baexam" class="form-label text-light-emphasis">Annual/Supplementary</label>
                    <select
                        class="form-control @error('baexam') is-invalid @enderror"
                        name="baexam"
                        id="baexam"
                        aria-describedby="baexam"
                        required
                    >
                        <option value="">Select Exam Type</option>
                        <option value="Annual" {{ (old('baexam') ?? Auth::user()->baeducation->baexam ?? '') === 'Annual' ? 'selected' : '' }}>Annual</option>
                        <option value="Supplementary" {{ (old('baexam') ?? Auth::user()->baeducation->baexam ?? '') === 'Supplementary' ? 'selected' : '' }}>Supplementary</option>
                    </select>
                    @error('baexam')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="baroll" class="form-label text-light-emphasis">Roll No</label>
                    <input type="text"
                        class="form-control  @error('baroll') is-invalid @enderror"
                        name="baroll"
                        id="baroll"
                        aria-describedby="baroll"
                        autocomplete="off"
                        value="{{ old('baroll') ?? Auth::user()->baeducation->baroll ?? '' }}"
                        required>
                    @error('baroll')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="batotal" class="form-label text-light-emphasis">Total Marks</label>
                    <input type="number"
                        class="form-control  @error('batotal') is-invalid @enderror"
                        name="batotal"
                        id="batotal"
                        aria-describedby="batotal"
                        autocomplete="off"
                        value="{{ old('batotal') ?? Auth::user()->baeducation->batotal ?? '' }}"
                        placeholder="e.g., 1100"
                        required>
                    @error('batotal')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="baobtained" class="form-label text-light-emphasis">Obtained Marks</label>
                    <input type="number"
                        class="form-control  @error('baobtained') is-invalid @enderror"
                        name="baobtained"
                        id="baobtained"
                        aria-describedby="baobtained"
                        autocomplete="off"
                        value="{{ old('baobtained') ?? Auth::user()->baeducation->baobtained ?? '' }}"
                        placeholder="e.g., 771"
                        required>
                    @error('baobtained')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bapercent" class="form-label text-light-emphasis">Percentage %</label>
                    <input type="number"
                        class="form-control  @error('bapercent') is-invalid @enderror"
                        name="bapercent"
                        id="bapercent"
                        aria-describedby="bapercent"
                        autocomplete="off"
                        value="{{ old('bapercent') ?? Auth::user()->baeducation->bapercent ?? '' }}"
                        placeholder="e.g., 85"
                        min="0"
                        max="100"
                        step="0.01"
                        required>
                    @error('bapercent')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="bagrade" class="form-label text-light-emphasis">Grade/Division</label>
                    <select
                        class="form-control @error('bagrade') is-invalid @enderror"
                        name="bagrade"
                        id="bagrade"
                        aria-describedby="bagrade"
                        required
                    >
                        <option value="">Select Grade/Division</option>
                        <option value="A" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'E' ? 'selected' : '' }}>E</option>
                        <option value="F" {{ (old('bagrade') ?? Auth::user()->baeducation->bagrade ?? '') === 'F' ? 'selected' : '' }}>F</option>
                    </select>
                    @error('bagrade')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Intermediate Ends --}}

</x-form-template>
