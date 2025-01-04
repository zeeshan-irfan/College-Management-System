<x-form-template
    id="updateAboutForm"
    method="POST"
    route="about.store"
    heading="Create Member"
    subheading="Create a new member here."
    button="Create Member"
>

    <div class="col-12 text-center">
        <img id="imageDisplay"
            src="{{asset('storage/images/logo/person.png') }}"
            name="image"
            height="100px"
            width="100px"
            class="img-thumbnail"
            alt="Profile" >

            <div class="my-3">
                <label for="image" class="btn btn-sm btn-outline-dark form-label "><i class="bi bi-image"></i> Upload Image</label>
                <input class="form-control d-none" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" >
                <br>
                @error('image')
                <div class="form-text invalid-feedback">{{$message}}</div>
                @enderror
                <small id="imageError" class="text-danger"></small>
            </div>
    </div>

    <!-- about Name -->
    <div class="col-12 mb-3">
        <label for="name" class="form-label text-light-emphasis">Full Name</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="e.g., John Doe"
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

    <!-- designation -->
    <div class="col-12 mb-3">
        <label for="text" class="form-label text-light-emphasis">Designation</label>
        <input
            type="designation"
            class="form-control @error('designation') is-invalid @enderror"
            placeholder="e.g., Developer, Professor e.t.c"
            name="designation"
            id="designation"
            aria-describedby="designation"
            autocomplete="designation"
            value="{{ old('designation') ?? '' }}"
            required
        >
        @error('designation')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-12 mb-3">
        <label for="email" class="form-label text-light-emphasis">Email Address (Optional)</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="e.g., user@example.com"
            name="email"
            id="email"
            aria-describedby="email"
            autocomplete="email"
            value="{{ old('email') ?? '' }}"
        >
        @error('email')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

        <!-- role -->
        <div class="col-12 mb-3">
            <label for="text" class="form-label text-light-emphasis">Role in Development</label>
            <input
                type="role"
                class="form-control @error('role') is-invalid @enderror"
                placeholder="e.g., Supervisor, Developer e.t.c"
                name="role"
                id="role"
                aria-describedby="role"
                autocomplete="role"
                value="{{ old('role') ?? '' }}"
                required
            >
            @error('role')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

            <!-- description -->
    <div class="col-12 mb-3">
        <label for="text" class="form-label text-light-emphasis">Description</label>
        <input
            type="description"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Lorem ipsum dolor sit amet,"
            name="description"
            id="description"
            aria-describedby="description"
            autocomplete="description"
            value="{{ old('description') ?? '' }}"
            required
        >
        @error('description')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

                <!-- Profile Link-->
                <div class="col-12 mb-3">
                    <label for="text" class="form-label text-light-emphasis">Profile Link</label>
                    <input
                        type="profile"
                        class="form-control @error('profile') is-invalid @enderror"
                        placeholder="https://www.linkedin.com/in/name.e.t.c"
                        name="profile"
                        id="profile"
                        aria-describedby="profile"
                        autocomplete="profile"
                        value="{{ old('profile') ?? '' }}"
                    >
                    @error('profile')
                        <div class="form-text invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



</x-form-template>
