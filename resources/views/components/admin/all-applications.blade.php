<x-content-box heading="Records" subheading="All records are listed below">
    <!-- Search Bar -->
    <div class="col-12 my-3">
        <form class="d-flex align-items-center" role="search" action="{{ route('records.search') }}" method="GET">
            @csrf
            <div class="input-group shadow-sm">
                <input
                    class="form-control border-0 rounded-start @error('search') is-invalid @enderror"
                    type="search"
                    name="search"
                    placeholder="🔍 Search applicants by name or email"
                    aria-label="Search"
                    value="{{ old('search') }}"
                    style="height: 45px; border-radius: 8px 0 0 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"
                >
                <button class="btn btn-success rounded-end" type="submit" style="height: 45px; border-radius: 0 8px 8px 0; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
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

    <!-- Download Button -->
    <div class="col-12 text-end p-3">
        <a href="{{route('export.index')}}" class="btn btn-outline-success btn-sm">
            <i class="fs-5 bi bi-cloud-arrow-down"></i> Download Records
        </a>
    </div>

    <!-- Records Table -->
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Semester</th>
                    <th>Batch</th>
                    <th>Program</th>
                    <th>Applied on</th>
                    <th>Name</th>
                    <th>Email</th>

                    @if ($records->pluck('user.personalinfo')->filter()->isNotEmpty())
                        <th>CNIC</th>
                        <th>Nationality</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Place of Birth</th>
                        <th>Domicile District</th>
                        <th>Domicile Province</th>
                        <th>Religion</th>
                        <th>Cell no</th>
                        <th>Hafiz e Quran</th>
                        <th>Disabled Candidate</th>
                    @endif

                    @if ($records->pluck('user.fatherinfo')->filter()->isNotEmpty())
                        <th>Father's Name</th>
                        <th>Guardian's Name (If any)</th>
                        <th>Guardian's Relation</th>
                        <th>Father/Guardian CNIC</th>
                        <th>Father/Guardian Income</th>
                    @endif

                    @if ($records->pluck('user.address')->filter()->isNotEmpty())
                        <th>Address Line</th>
                        <th>City</th>
                        <th>State/Province</th>
                        <th>Country</th>
                        <th>Contact</th>
                    @endif

                    @foreach (['Matric', 'Inter', 'BA/BSC', 'MA/MSc/BS'] as $edu)
                        <th>{{ $edu }} Degree</th>
                        <th>{{ $edu }} Board</th>
                        <th>{{ $edu }} Institute</th>
                        <th>{{ $edu }} Passing Year</th>
                        <th>{{ $edu }} Exam</th>
                        <th>{{ $edu }} Roll No</th>
                        <th>{{ $edu }} Total Marks</th>
                        <th>{{ $edu }} Obtained Marks</th>
                        <th>{{ $edu }} Percentage</th>
                        <th>{{ $edu }} Grade</th>
                    @endforeach

                    @if ($records->pluck('challan')->filter()->isNotEmpty())
                        <th>Challan No</th>
                        <th>Challan Fee</th>
                        <th>Challan Status</th>
                    @endif

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>{{ $loop->iteration + ($records->currentPage() - 1) * $records->perPage() }}</td>
                        <td>{{ $record->admission->semester }}</td>
                        <td>{{ $record->admission->batch }}</td>
                        <td>{{ $record->program->name }}</td>
                        <td>{{ $record->created_at->format('d-M-Y , H:i') }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->user->email }}</td>

                        @if ($record->user->personalinfo)
                            <td>{{ $record->user->personalinfo->cnic }}</td>
                            <td>{{ $record->user->personalinfo->nationality }}</td>
                            <td>{{ $record->user->personalinfo->gender }}</td>
                            <td>{{ $record->user->personalinfo->dob }}</td>
                            <td>{{ $record->user->personalinfo->pob }}</td>
                            <td>{{ $record->user->personalinfo->domicileDist }}</td>
                            <td>{{ $record->user->personalinfo->domicileProvince }}</td>
                            <td>{{ $record->user->personalinfo->religion }}</td>
                            <td>{{ $record->user->personalinfo->contact }}</td>
                            <td>{{ $record->user->personalinfo->hafiz }}</td>
                            <td>{{ $record->user->personalinfo->disabled }}</td>
                        @endif

                        @if ($record->user->fatherinfo)
                            <td>{{ $record->user->fatherinfo->fname }}</td>
                            <td>{{ $record->user->fatherinfo->gname }}</td>
                            <td>{{ $record->user->fatherinfo->grelation }}</td>
                            <td>{{ $record->user->fatherinfo->fcnic }}</td>
                            <td>{{ $record->user->fatherinfo->income }}</td>
                        @endif

                        @if ($record->user->address)
                            <td>{{ $record->user->address->line }}</td>
                            <td>{{ $record->user->address->city }}</td>
                            <td>{{ $record->user->address->province }}</td>
                            <td>{{ $record->user->address->country }}</td>
                            <td>{{ $record->user->address->contact }}</td>
                        @endif

                        @foreach (['matriceducation', 'intereducation', 'baeducation', 'bseducation'] as $edu)
                            @php
                                $prefix = '';
                                if ($edu == 'matriceducation') {
                                    $prefix = 'm';
                                } elseif ($edu == 'intereducation') {
                                    $prefix = 'i';
                                } elseif ($edu == 'baeducation') {
                                    $prefix = 'ba';
                                } elseif ($edu == 'bseducation') {
                                    $prefix = 'bs';
                                }
                            @endphp

                            <td>{{ $record->user->$edu->degree->name ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'board'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'institute'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'year'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'exam'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'roll'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'total'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'obtained'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'percent'} ?? ' ' }}</td>
                            <td>{{ $record->user->$edu->{$prefix.'grade'} ?? ' ' }}</td>
                        @endforeach

                        @if ($record->challan)
                            <td>{{ $record->challan->challan_no }}</td>
                            <td>{{ $record->challan->fee }}</td>
                            <td>{{ $record->challan->status }}</td>
                        @endif

                        <td>
                            <form id="deleteForm-{{ $record->id }}" action="{{ route('record.destroy', $record->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, 'deleteForm-{{ $record->id }}')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $records->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-content-box>
