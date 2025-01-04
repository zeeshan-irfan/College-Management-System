@extends('layouts.user')

@section('main')

<x-body-heading heading="Admissions Applied" subheading="View the history of programs you have applied for." />

@if (!empty($records) && $records->isNotEmpty())
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-journal-text text-black"></i> Your Admissions</h5>
            <a href="{{ route('admission.apply') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Apply for New Admission
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="bg-gradient-secondary text-white">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Admission</th>
                            <th scope="col">Program</th>
                            <th scope="col">Status</th>
                            <th scope="col">Applied On</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold text-primary">{{ $record->admission->semester }}</span>
                                    <small class="text-muted">({{ $record->admission->batch }})</small>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $record->program->name }}</span>
                                </td>
                                <td>
                                    @if ($record->admission->status == true)
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock-history"></i> Processing
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle"></i> Closed
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">
                                        <i class="bi bi-calendar3"></i> {{ $record->created_at->format('d-m-Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('challan.download',$record->id)}}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Download Challan">
                                        <i class="bi bi-receipt"></i> Download Challan
                                    </a>
                                    {{-- <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Record">
                                        <i class="bi bi-trash"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning text-center shadow-sm">
        <h4 class="text-muted"><i class="bi bi-exclamation-circle"></i> No Records Found</h4>
        <p class="mt-2">
            You have not applied to any programs yet. Click the button below to view available admissions.
        </p>
        <a class="btn btn-warning btn-lg mt-3" href="{{ route('admission.apply') }}">
            <i class="bi bi-arrow-right-circle"></i> Apply for Admissions
        </a>
    </div>
@endif

@endsection

@push('script')
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
