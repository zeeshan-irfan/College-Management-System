<x-form-template
                id="updateInterForm"
                method="PUT"
                route="updateInterEducation"
                heading="Academic Record (B)"
                subheading="Update your Intermediate education details here.">

    <div class="col-12 my-3">
        <h6 class="mb-0 text-primary-emphasis heading-line text-center">Intermediate or Equivalent </h6>
    </div>


    {{-- Intermediate Starts --}}
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="idegree" class="form-label text-light-emphasis">Degree</label>
                    <select
                        class="form-control @error('idegree') is-invalid @enderror"
                        name="idegree"
                        id="idegree"
                        aria-describedby="idegree"
                        required
                    >
                        <option value="">Select Degree</option>
                        @if ($degrees->isNotEmpty())
                            @foreach ($degrees as $degree)
                                <option
                                    value="{{ $degree->id }}"
                                    {{ (old('idegree') ?? optional(Auth::user()->intereducation)->degree_id ?? '') === $degree->id ? 'selected' : '' }}
                                >
                                    {{ $degree->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>No degrees available</option>
                        @endif
                    </select>
                    @error('idegree')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iboard" class="form-label text-light-emphasis">Board</label>
                    <input type="text"
                            class="form-control  @error('iboard') is-invalid @enderror"
                            name="iboard"
                            id="iboard"
                            aria-describedby="iboard"
                            autocomplete="no"
                            value="{{ old('iboard') ?? Auth::user()->intereducation->iboard ?? '' }}"
                            required>
                    @error('iboard')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iinstitute" class="form-label text-light-emphasis">Name of Institution</label>
                    <input type="text"
                            class="form-control  @error('iinstitute') is-invalid @enderror"
                            name="iinstitute"
                            id="iinstitute"
                            aria-describedby="iinstitute"
                            autocomplete="no"
                            value="{{ old('iinstitute') ?? Auth::user()->intereducation->iinstitute ?? '' }}"
                            required>
                    @error('iinstitute')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iyear" class="form-label text-light-emphasis">Passing year</label>
                    <input
                        type="number"
                        class="form-control  @error('iyear') is-invalid @enderror"
                        name="iyear"
                        id="iyear"
                        aria-describedby="iyear"
                        autocomplete="off"
                        value="{{ old('iyear') ?? Auth::user()->intereducation->iyear ?? '' }}"
                        min="1900" max="2080"
                        required
                    >
                    @error('iyear')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iexam" class="form-label text-light-emphasis">Annual/Supplementary</label>
                    <select
                        class="form-control @error('iexam') is-invalid @enderror"
                        name="iexam"
                        id="iexam"
                        aria-describedby="iexam"
                        required
                    >
                        <option value="">Select Exam Type</option>
                        <option value="Annual" {{ (old('iexam') ?? Auth::user()->intereducation->iexam ?? '') === 'Annual' ? 'selected' : '' }}>Annual</option>
                        <option value="Supplementary" {{ (old('iexam') ?? Auth::user()->intereducation->iexam ?? '') === 'Supplementary' ? 'selected' : '' }}>Supplementary</option>
                    </select>
                    @error('iexam')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iroll" class="form-label text-light-emphasis">Roll No</label>
                    <input type="text"
                        class="form-control  @error('iroll') is-invalid @enderror"
                        name="iroll"
                        id="iroll"
                        aria-describedby="iroll"
                        autocomplete="off"
                        value="{{ old('iroll') ?? Auth::user()->intereducation->iroll ?? '' }}"
                        required>
                    @error('iroll')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="itotal" class="form-label text-light-emphasis">Total Marks</label>
                    <input type="number"
                        class="form-control  @error('itotal') is-invalid @enderror"
                        name="itotal"
                        id="itotal"
                        aria-describedby="itotal"
                        autocomplete="off"
                        value="{{ old('itotal') ?? Auth::user()->intereducation->itotal ?? '' }}"
                        placeholder="e.g., 1100"
                        required>
                    @error('itotal')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="iobtained" class="form-label text-light-emphasis">Obtained Marks</label>
                    <input type="number"
                        class="form-control  @error('iobtained') is-invalid @enderror"
                        name="iobtained"
                        id="iobtained"
                        aria-describedby="iobtained"
                        autocomplete="off"
                        value="{{ old('iobtained') ?? Auth::user()->intereducation->iobtained ?? '' }}"
                        placeholder="e.g., 771"
                        required>
                    @error('iobtained')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="ipercent" class="form-label text-light-emphasis">Percentage %</label>
                    <input type="number"
                        class="form-control  @error('ipercent') is-invalid @enderror"
                        name="ipercent"
                        id="ipercent"
                        aria-describedby="ipercent"
                        autocomplete="off"
                        value="{{ old('ipercent') ?? Auth::user()->intereducation->ipercent ?? '' }}"
                        placeholder="e.g., 85"
                        min="0"
                        max="100"
                        step="0.01"
                        required>
                    @error('ipercent')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-3">
                    <label for="igrade" class="form-label text-light-emphasis">Grade/Division</label>
                    <select
                        class="form-control @error('igrade') is-invalid @enderror"
                        name="igrade"
                        id="igrade"
                        aria-describedby="igrade"
                        required
                    >
                        <option value="">Select Grade/Division</option>
                        <option value="A" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'E' ? 'selected' : '' }}>E</option>
                        <option value="F" {{ (old('igrade') ?? Auth::user()->intereducation->igrade ?? '') === 'F' ? 'selected' : '' }}>F</option>
                    </select>
                    @error('igrade')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Intermediate Ends --}}

</x-form-template>
