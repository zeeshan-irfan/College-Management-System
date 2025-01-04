<x-content-box heading="Banks" subheading="All banks are listed below">

    <div class="col-12 text-end">
        <a href="#createBankForm" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Create New Bank
        </a>
    </div>

    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Account</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banks as $bank)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($banks->currentPage() - 1) * $banks->perPage() }}</td>
                        <td>{{ $bank->name }}</td>
                        <td class="text-muted">{{ $bank->account }}</td>
                        <td>
                            @if ($bank->logo)
                                <img src="{{ asset('storage/' . $bank->logo) }}" alt="{{ $bank->name }}" class="img-thumbnail" width="50">
                            @else
                                <span class="text-muted">No Logo</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $bank->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Action buttons -->
                            <a href="{{ route('bank.edit', $bank->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete button -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No banks found.
                            <a href="#createBankForm" class="btn btn-sm btn-primary ms-2">
                                Add bank
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $banks->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-content-box>
