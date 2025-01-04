{{-- Nav Bar Starts --}}
<div class="container-fluid h-100 shadow">
  <div class="row h-100">
      <div class="col-12 p-0">
          <nav id="MainNavigationBar" class="navbar navbar-expand-sm   h-100" data-bs-theme="dark">
              <div class="container-fluid flex-sm-column align-items-sm-start h-100">
                  <a class="navbar-brand">{{ config('app.name', 'DefaultAppName') }}</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userMainNavigationBar" aria-controls="userMainNavigationBar" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse w-100" id="userMainNavigationBar">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-sm-flex flex-sm-column align-items-sm-start h-100 w-100">
                        {{ $slot }}
                      </ul>
                  </div>
              </div>
          </nav>
      </div>
  </div>
</div>
{{-- Nav Bar Ends --}}
