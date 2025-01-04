<x-form-template
    id="updateUserForm"
    method="POST"
    route="user.store"
    heading="Create User"
    subheading="Create a new user here."
    button="Add"
>
    <!-- User Name -->
    <div class="col-12 mb-3">
        <label for="name" class="form-label text-light-emphasis">Full User Name</label>
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

    <!-- Email -->
    <div class="col-12 mb-3">
        <label for="email" class="form-label text-light-emphasis">Email Address</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="e.g., user@example.com"
            name="email"
            id="email"
            aria-describedby="email"
            autocomplete="email"
            value="{{ old('email') ?? '' }}"
            required
        >
        @error('email')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="col-12 mb-3">
        <label for="password" class="form-label text-light-emphasis">Password</label>
        <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Enter a strong password"
            name="password"
            id="password"
            autocomplete="new-password"
            required
        >
        @error('password')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Confirmation -->
    <div class="col-12 mb-3">
        <label for="password_confirmation" class="form-label text-light-emphasis">Confirm Password</label>
        <input
            type="password"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            placeholder="Re-enter your password"
            name="password_confirmation"
            id="password_confirmation"
            autocomplete="new-password"
            required
        >
        @error('password_confirmation')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <!-- Static Role Selection -->
    <div class="col-12 mb-3">
        <label for="role" class="form-label text-light-emphasis">Select Role</label>
        <select
            class="form-select @error('role') is-invalid @enderror"
            name="role"
            id="role"
            required
        >
            <option value="1" {{ old('role') == 'user' ? 'selected' : '' }} selected>User</option>
            <option value="2" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="3" {{ old('role') == 'clerk' ? 'selected' : '' }}>Clerk</option>
            <option value="4" {{ old('role') == 'hod' ? 'selected' : '' }}>HOD</option>
            <option value="5" {{ old('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
            <option value="6" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
        </select>
        @error('role')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

     <!-- Role Descriptions -->
     <div class="form-text text-muted mb-2">
        <ul class="mb-0 ps-3">
            <li><strong>User</strong>: General user which can only apply for admission.</li>
            <li><strong>Admin</strong>: Full access to manage the system and users.</li>
            <li><strong>Clerk</strong>: Handles administrative tasks and data entry.</li>
            <li><strong>HOD</strong>: Head of department, manages department activities.</li>
            <li><strong>Faculty</strong>: Teaching staff with access to relevant tools.</li>
            <li><strong>Student</strong>: Access to learning materials and course resources.</li>
        </ul>
    </div>
</x-form-template>
