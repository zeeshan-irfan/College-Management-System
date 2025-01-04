<x-form-template id="sendEmailForm" 
                method="POST"
                 route="contact.send" 
                 heading="Email Us" 
                 subheading="You can email us by filling the form below, you will be contacted as soon as possible."
                 button="Send">

    <div class="mb-3">
        <label for="name" class="form-label text-light-emphasis">Your Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="name" autocomplete="name" value="{{ old('name') ?? Auth::user()->name ?? '' }}" required>
        @error('name')
        <div class="form-text invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label text-light-emphasis">Your Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="email" autocomplete="email" value="{{ old('email') ?? Auth::user()->email ?? '' }}" required>
        @error('email')
        <div class="form-text invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <!-- Subject -->
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter the subject" required>
    </div>

    <!-- Message -->
    <div class="mb-3">
        <label for="message" class="form-label">Your Message</label>
        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
    </div>

   
</x-form-template>