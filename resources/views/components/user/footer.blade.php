<x-main-footer>
    <!-- Links Section -->
    <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h5 class="text-white">Links</h5>
        <ul class="list-unstyled">
          <li><a href="{{route('user.home')}}" class="text-decoration-none ">Home</a></li>
          <li><a href="{{route('user.profile')}}" class="text-decoration-none ">Profile</a></li>
          <li><a href="{{route('user.account')}}" class="text-decoration-none ">Account</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h5 class="text-white">About</h5>
        <ul class="list-unstyled">
          <li><a href="{{route('user.about')}}" class="text-decoration-none ">Team</a></li>
          <li><a href="{{route('user.help')}}" class="text-decoration-none ">Contact us</a></li>
        </ul>
      </div>
</x-main-footer>
