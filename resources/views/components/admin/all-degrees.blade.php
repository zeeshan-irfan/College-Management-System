<x-content-box heading="Degrees" subheading="All degrees are listed below">

    <div class="col-12 text-end">
        <a href="#createDegreeForm" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Create New Degree
        </a>
    </div>

    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($degrees as $degree)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($degrees->currentPage() - 1) * $degrees->perPage() }}</td>
                        <td class="">{{ $degree->name }}</td>
                        <td class="text-muted">{{ $degree->type }}</td>
                        <td>
                            <span class="badge {{ $degree->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $degree->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $degree->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Action buttons -->
                            <a href="{{ route('degree.edit', $degree->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete button -->
                            <form id="deleteForm-{{ $degree->id }}" action="{{ route('degree.destroy', $degree->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $degree->id }}')">Delete</button>
                            </form>

                            <!-- Linking button -->
                            @if ($degree->type !== 'Matric or Equivalent')
                                <a href="{{ route('degree.linkpage', $degree->id) }}" class="btn btn-sm btn-secondary" aria-label="Link Programs to Degree">
                                    <i class="bi bi-share"></i> Linking
                                </a>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No degrees found.
                            <a href="#createDegreeForm" class="btn btn-sm btn-primary ms-2">
                                Add degree
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $degrees->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-content-box>
