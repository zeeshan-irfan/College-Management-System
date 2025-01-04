<x-form-template 
                id="createProgramForm"
                method="POST"
                route="program.store" 
                heading="Create program" 
                subheading="Add a new program here."
                button="Add">

   

                <div class="col-12">
                    <div class="mb-3">
                        <label for="department" class="form-label text-light-emphasis">Select Department</label>
                        <select 
                            class="form-control @error('department') is-invalid @enderror" 
                            name="department" 
                            id="department" 
                            aria-describedby="departmentHelp" 
                            required
                        >
                            <option value="" disabled selected>Select a department</option>
                            @foreach ($departments as $department)
                                <option 
                                    value="{{ $department->id }}" 
                                    {{ old('department') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="form-text invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
    
    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label text-light-emphasis">Full Program Name</label>
            <input type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="eg., BS Information Technology, M.Phil English, etc"
                    name="name" 
                    id="name" 
                    aria-describedby="name" 
                    autocomplete="name" 
                    value="{{ old('name') ?? '' }}" 
                    required 
                    >
            @error('name')
                <div class="form-text invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
                
    

   
    

</x-form-template>