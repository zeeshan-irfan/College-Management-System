@if ($percentage >= 70 || true)

<x-form-template
    id="applyAdmission"
    method="POST"
    route="record.store"
    heading="Apply for New Admission"
    subheading="Fill the form and click Apply."
    button="Apply Now">

    <!-- Admission Section -->
    <div class="row mb-4">
        <div class="col-12 col-sm-6">
            <div class="mb-3">
                <label for="admission" class="form-label text-primary fw-bold">Admission Semester</label>
                <select
                    class="form-select shadow-sm @error('admission') is-invalid @enderror"
                    name="admission"
                    id="admission"
                    aria-describedby="admission"
                    required>
                    <option value="" disabled selected>Select Admission</option>
                    @if (!empty($admissions) && $admissions->isNotEmpty())
                        @foreach ($admissions as $admission)
                            <option
                                value="{{ $admission->id }}"
                                {{ (old('admission') ?? '') === $admission->semester.' '.$admission->batch  ? 'selected' : '' }}>
                                {{ $admission->semester.' '.$admission->batch }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>No admissions available</option>
                    @endif
                </select>
                @error('admission')
                    <div class="form-text invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Program Section -->
        <div class="col-12 col-sm-6">
            <div class="mb-3">
                <label for="program" class="form-label text-primary fw-bold">Choose Program</label>
                <select
                    class="form-select shadow-sm @error('program') is-invalid @enderror"
                    name="program"
                    id="program"
                    aria-describedby="program"
                    required>
                    <option value="" disabled selected>Select Program</option>
                    @if (!empty($programs) && $programs->isNotEmpty())
                        @foreach ($programs as $program)
                            <option
                                value="{{ $program->id }}"
                                {{ (old('program') ?? '') === $program->name ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>No programs available</option>
                    @endif
                </select>
                @error('program')
                    <div class="form-text invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text fst-italic text-muted mt-2">
                    Programs are listed according to your qualification. If you don't see a program, ensure your qualification matches or update it in your profile.
                </div>
            </div>
        </div>
    </div>

</x-form-template>

@else

<div class="container-fluid bg-white shadow-sm rounded-3 p-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="alert alert-warning shadow-lg p-4 rounded-4 border border-danger" role="alert">
                <h3 class="text-danger fw-bold mb-3">
                    🚨 Complete Your Profile to Proceed! 🚨
                </h3>
                <h5 class="text-secondary mb-4">
                    You must complete at least <strong class="text-dark">70%</strong> of your profile to apply for new admissions.
                </h5>
                <a href="{{ route('user.profile') }}" class="btn btn-danger btn-lg px-5 py-3 text-white fw-semibold shadow-sm">
                    Go to Your Profile
                </a>
            </div>
            <p class="text-muted fst-italic mt-4">
                Completing your profile will unlock the next steps. Don’t miss out! 🚀
            </p>
        </div>
    </div>
</div>

@endif
