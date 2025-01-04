<footer id="footer" class=" shadow" >
    <div class="container-fluid">
      <div class="row py-5 text-center text-md-start">
        <!-- Logo and Name Section -->
        <div class="col-6 col-md-3 mb-4 mb-md-0 text-center">
          <img src="{{ asset(config('app.logo')) }}" alt="University Logo" class="img-fluid bg-secondary-subtle rounded-4" style="max-width: 120px;">
          <h5 class="mt-3">{{ config('app.fullname') }}</h5>
        </div>

        {{$slot}}

        <div class="col-6 col-md-3 mb-4 mb-md-0">
          <h5 class="text-white">Follow us</h5>
          <ul class="list-unstyled">
            <li><a  class="text-decoration-none text-primary"><i class="bi bi-facebook"></i></a></li>
            <li><a  class="text-decoration-none text-dark"><i class="bi bi-twitter-x"></i></a></li>
            <li><a  class="text-decoration-none text-danger"><i class="bi bi-youtube"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-12 m-0 p-0 text-center text-dark bg-dark-subtle shadow">
        <p class="m-0 p-0">Copyright@ (zeeshanirfan131@gmail.com)</p>
      </div>
    </div>
  </footer>
