<x-content-box heading="Programs" subheading="All programs are listed below">

    <div class="col-12 text-end">
        <a href="#createProgramForm" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Create New Program
        </a>
    </div>

    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Program</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($programs->currentPage() - 1) * $programs->perPage() }}</td>
                        <td>{{ $program->name }}</td>
                        <td class="text-muted">{{ $program->department->name}}</td>

                        <td>
                            <span class="badge {{ $program->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $program->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $program->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Action buttons -->
                            <a href="{{ route('program.edit', $program->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete button -->
                            <form id="deleteForm-{{ $program->id }}" action="{{ route('program.destroy', $program->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $program->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No programs found.
                            <a href="#createProgramForm" class="btn btn-sm btn-primary ms-2">
                                Add program
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $programs->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-content-box>
