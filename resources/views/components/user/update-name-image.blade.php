<x-form-template
                id="updateNameImageForm"
                method="PUT"
                 route="updateNameImage"
                 heading="Account Information"
                 subheading="Update your account's profile name and picture.">

    <div class="col-sm-8 order-3 order-sm-2">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="name" autocomplete="name" value="{{ old('name') ?? Auth::user()->name ?? '' }}" required>
            @error('name')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-light-emphasis">Email</label>
            <input type="email" class="form-control disabled text-muted  @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="email" autocomplete="email" value="{{ old('email') ?? Auth::user()->email ?? '' }}" readonly>
            @error('email')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 order-2 order-sm-3 text-center">
        <img id="imageDisplay"
            src="{{ isset(Auth::user()->image->path) ? asset('storage/'.Auth::user()->image->path) : asset('storage/images/logo/person.png') }}"
            name="image"
            height="100px"
            width="100px"
            class="img-thumbnail"
            alt="Profile">

            <div class="my-3">
                <label for="image" class="btn btn-sm btn-outline-dark form-label "><i class="bi bi-image"></i> Change Image</label>
                <input class="form-control d-none" type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
                <br>
                @error('image')
                <div class="form-text invalid-feedback">{{$message}}</div>
                @enderror
                <small id="imageError" class="text-danger"></small>
            </div>
    </div>
</x-form-template>
