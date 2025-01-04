<x-form-template
                id="updateDepartmentForm"
                method="POST"
                route="department.store"
                heading="Create department"
                subheading="Create a new department here."
                button="Add">



    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Department Name</label>
            <input type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="eg., Department of xxxxxxxxxxxxxx"
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
