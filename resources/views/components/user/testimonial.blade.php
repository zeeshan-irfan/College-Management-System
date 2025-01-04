{{-- Single Testimonial Card --}}
<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="p-4 bg-light rounded-4 shadow-lg d-flex flex-column align-items-center text-center " style="transition: transform 0.3s ease;">



        <!-- Profile Image -->
        <img src="{{  isset($member->image) ? asset('storage/'.$member->image) : asset('storage/images/logo/person.png') }}" width="100" height="100" alt="Testimonial image" class="rounded-circle mb-3 mt-3 mx-auto border border-1 border-secondary-subtle" style="transition: box-shadow 0.3s;">

        <!-- Name and Role -->
        <a
            class="text-decoration-none"
            href="{{ strpos($member->profile, 'http') === 0 ? $member->profile : 'https://' . $member->profile }}"
            target="_blank"
            rel="noopener noreferrer">
            <h5 class="text-secondary-emphasis fw-bold mb-1">{{ $member->name }}</h5>
        </a>
        <p class="text-muted mb-0"><small>{{$member->designation}}</small></p>
        <p class="text-body-tertiary mb-2"><small>{{$member->email}}</small></p>

        <hr class="w-50 mx-auto">

        <!-- Supervisor Role -->
        <h6 class="text-primary-emphasis fw-semibold mb-1">{{$member->role}}</h6>

        <!-- Testimonial Text -->
        <p class="text-secondary px-2" style="font-style: italic;">{{$member->description}}</p>
        @if (Auth::user()->roles->first()->name=='admin')


            <form id="deleteForm-{{ $member->id }}" action="{{route('about.destroy',$member->id)}}" method="POST">
                @method("POST")
                @csrf
                <a class="btn btn-sm btn-outline-dark " href="{{route('about.edit',$member->id)}}"><i class="bi bi-pencil-square"> Edit</i> </a>
                <button type="submit" class="btn btn-sm btn-outline-danger " onclick="confirmDelete(event, 'deleteForm-{{ $member->id }}')"><i class="bi bi-trash3"> Delete</i> </button>
            </form>
        @endif

    </div>
</div>
{{-- End Single Testimonial Card --}}
