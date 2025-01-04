<x-content-box heading="Departments" subheading="All departments are listed below">

    <div class="col-12 text-end">
        <a href="#updateDepartmentForm" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Create New Department
        </a>
    </div>

    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $department)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}</td>
                        <td >{{ $department->name }}</td>
                        <td>
                            <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $department->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $department->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Action buttons -->
                            <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete button -->
                            <form id="deleteForm-{{ $department->id }}" action="{{ route('department.destroy', $department->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $department->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No departments found.
                            <a href="#updateDepartmentForm" class="btn btn-sm btn-primary ms-2">
                                Add Department
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $departments->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-content-box>
