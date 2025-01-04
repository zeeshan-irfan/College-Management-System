<x-form-template id="updatefatherInfoForm" method="PUT"
                 route="updatefatherInfo" 
                 heading="Father/Guardian particulars" 
                 subheading="Update your father/guardian particulars info here.">

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="fname" class="form-label text-light-emphasis">Father's Name</label>
            <input type="text" 
                   class="form-control @error('fname') is-invalid @enderror" 
                   name="fname" 
                   id="fname" 
                   aria-describedby="fname" 
                   autocomplete="off" 
                   value="{{ old('fname') ?? Auth::user()->fatherinfo->fname ?? '' }}" 
                   required>
            @error('fname')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="gname" class="form-label text-light-emphasis">Guardian's Name (If any)</label>
            <input type="text" 
                   placeholder="(Optional)" 
                   class="form-control @error('gname') is-invalid @enderror" 
                   name="gname" 
                   id="gname" 
                   aria-describedby="gname" 
                   autocomplete="off" 
                   value="{{ old('gname') ?? Auth::user()->fatherinfo->gname ?? '' }}">
            @error('gname')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="grelation" class="form-label text-light-emphasis">Guardian's Relation with Applicant (If any)</label>
            <input type="text" 
                   placeholder="(Optional)" 
                   class="form-control @error('grelation') is-invalid @enderror" 
                   name="grelation" 
                   id="grelation" 
                   aria-describedby="grelation" 
                   autocomplete="off" 
                   value="{{ old('grelation') ?? Auth::user()->fatherinfo->grelation ?? '' }}">
            @error('grelation')
            <div class="form-text invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="fcnic" class="form-label text-light-emphasis">Father/Guardian CNIC</label>
            <input type="number" 
                   class="form-control @error('fcnic') is-invalid @enderror" 
                   name="fcnic" 
                   id="fcnic" 
                   aria-describedby="fcnic" 
                   autocomplete="off" 
                   pattern="^\d{13}$" 
                   placeholder="e.g., 38xxxxxxxxxxx"
                   title="CNIC must be exactly 13 digits"
                   value="{{ old('fcnic') ?? Auth::user()->fatherinfo->fcnic ?? '' }}" 
                   required>
            @error('fcnic')
            <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="mb-3">
            <label for="income" class="form-label text-light-emphasis">
                Father/Guardian's Annual Income from all sources (<b>In PKR</b>)
            </label>
            <input type="number" 
                   class="form-control @error('income') is-invalid @enderror" 
                   name="income" 
                   id="income" 
                   aria-describedby="income" 
                   autocomplete="off" 
                   placeholder="Enter income in PKR"
                   min="0" 
                   step="1" 
                   value="{{ old('income') ?? Auth::user()->fatherinfo->income ?? '' }}" 
                   required>
            @error('income')
            <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</x-form-template>
