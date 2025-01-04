@extends('layouts.admin')

@section('main')

<x-body-heading heading="users" subheading="Manage all users from here." />

<x-form-template
    id="updateUserForm"
    method="PUT"
    route="user.update"
    routeid="{{ $user->id }}"
    heading="Update User"
    subheading="Update user details here."
    button="Update"
>

    <!-- Profile Image -->
    <div class="col-12 text-center mb-4">
        <img
            src="{{ isset($user->image->path) ? asset('storage/'.$user->image->path) : asset('storage/images/logo/person.png') }}"
            alt="User Image"
            class="rounded-circle border shadow"
            height="100px"
            width="100px"
        >
    </div>

    <!-- User Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="e.g., John Doe"
            name="name"
            id="name"
            autocomplete="name"
            value="{{ old('name', $user->name) }}"
            required
        >
        @error('name')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="e.g., user@example.com"
            name="email"
            id="email"
            autocomplete="email"
            value="{{ old('email', $user->email) }}"
            required
        >
        @error('email')
            <div class="form-text invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Static Role Selection -->
    <div class="mb-3">
        <label for="role" class="form-label">Select Role</label>
        <select
            class="form-select @error('role') is-invalid @enderror"
            name="role"
            id="role"
            required
        >
            <option value="1" {{ old('role', $user->roles->pluck('id')->contains(1) ? '1' : '') == '1' ? 'selected' : '' }}>User</option>
            <option value="2" {{ old('role', $user->roles->pluck('id')->contains(2) ? '2' : '') == '2' ? 'selected' : '' }}>Admin</option>
            <option value="3" {{ old('role', $user->roles->pluck('id')->contains(3) ? '3' : '') == '3' ? 'selected' : '' }}>Clerk</option>
            <option value="4" {{ old('role', $user->roles->pluck('id')->contains(4) ? '4' : '') == '4' ? 'selected' : '' }}>HOD</option>
            <option value="5" {{ old('role', $user->roles->pluck('id')->contains(5) ? '5' : '') == '5' ? 'selected' : '' }}>Faculty</option>
            <option value="6" {{ old('role', $user->roles->pluck('id')->contains(6) ? '6' : '') == '6' ? 'selected' : '' }}>Student</option>
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

@endsection

@push('script')

@endpush
