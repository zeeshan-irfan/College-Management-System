<x-content-box heading="Users" subheading="All users are listed below">
    <!-- Search Bar -->
    <div class="col-12 my-3">
        <form class="d-flex align-items-center" role="search" action="{{ route('user.search') }}" method="GET">
            @csrf
            <div class="input-group shadow-sm">
                <input
                    class="form-control border-0 rounded-start @error('search') is-invalid @enderror"
                    type="search"
                    name="search"
                    placeholder="🔍 Search users by name or email"
                    aria-label="Search"
                    value="{{ old('search') }}"
                    style="height: 45px;"
                >
                <button class="btn btn-success rounded-end" type="submit" style="height: 45px;">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
            @error('search')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </form>
    </div>

    <!-- Create Button -->
    <div class="col-12 text-end mb-3">
        <a href="#updateUserForm" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Create New User
        </a>
    </div>

    <!-- User Table -->
    <div class="col-12">
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 10%;">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" style="width: 15%;">Registered On</th>
                        <th scope="col" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="text-center">
                                <img src="{{ isset($user->image->path) ? asset('storage/'.$user->image->path) : asset('storage/images/logo/person.png') }}"
                                     alt="User Image"
                                     class="img-fluid rounded-circle"
                                     style="height: 40px; width: 40px; object-fit: cover;">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td class="text-dark">{{ $user->email }}</td>
                            <td class="text-dark">{{ $user->roles->first()->name ?? 'N/A' }}</td>
                            <td class="text-muted">{{ $user->created_at->format('d-M-Y') }}</td>
                            <td>
                                <!-- Action Buttons -->
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form id="deleteForm-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $user->id }}')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <h5 class="text-muted mb-3">No users found.</h5>
                                <a href="#updateUserForm" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Add User
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $users->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
</x-content-box>
