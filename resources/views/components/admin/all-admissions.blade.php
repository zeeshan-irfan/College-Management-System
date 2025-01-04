<x-content-box heading="Admissions" subheading="All admissions are listed below">

    <div class="col-12 text-end">
        <a href="#createAdmissionForm" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Start New Admission
        </a>
    </div>

    <div class="col-12">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Status</th>
                    <th scope="col">Applications</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Last Date to Apply</th>
                    <th scope="col">Challan Fee</th>
                    <th scope="col">Challan Last Date</th>
                    <th scope="col">Total Applications</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admissions as $admission)
                    <tr>
                        <!-- Iteration Number -->
                        <td class="text-muted">{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}</td>

                        <!-- Semester -->
                        <td>{{ ucfirst($admission->semester) }}</td>

                        <!-- Batch -->
                        <td>{{ $admission->batch }}</td>

                        <!-- Status -->
                        <td>
                            <span class="badge {{ $admission->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $admission->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Applications -->
                        <td class="text-muted">Applications</td>

                        <!-- Created At -->
                        <td class="text-muted">{{ $admission->created_at->format('Y-m-d H:i') }}</td>

                        <!-- Last Date to Apply -->
                        <td class="text-muted">{{ $admission->last_date->format('Y-m-d') }}</td>

                        <!-- Challan Fee -->
                        <td class="text-muted">{{ $admission->challan_fee }}</td>

                        <!-- Challan Last Date -->
                        <td class="text-muted">{{ $admission->challan_last_date->format('Y-m-d') }}</td>
                        <td class="fw-bold fs-5 text-success-emphasis">{{ $admission->records->count() }}</td>

                        <!-- Actions -->
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('admission.edit', $admission->id) }}" class="btn btn-sm btn-warning m-1">
                                Edit
                            </a>

                            <form action="{{route('records.export')}}" method="GET" id="downloadApplicationsForm">
                                    @csrf
                                    @method("GET")
                                <!-- Admission Filter -->
                                <input type="hidden" name="admission" value="{{ $admission->id }}" readonly required>
                                <input type="hidden" name="program" value="" readonly>

                                <button type="submit" class="btn btn-sm btn-success text-nowrap m-1">
                                    Download All Applications
                                </button>
                            </form>

                            <!-- Delete Button -->
                            {{-- <form id="deleteForm-{{ $admission->id }}" action="{{ route('admission.destroy', $admission->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $admission->id }}')">
                                    Delete
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            No admissions found.
                            <a href="#createAdmissionForm" class="btn btn-sm btn-primary ms-2">
                                Add Admission
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $admissions->links() }}
        </div>
    </div>

</x-content-box>
