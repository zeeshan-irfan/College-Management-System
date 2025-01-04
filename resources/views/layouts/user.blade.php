<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <x-main-head />

    <x-main-header />
    <body class="bg-body-secondary">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-2 p-0">
            <x-user.navbar />
          </div>
          <div class="col-sm-9 col-md-10 p-0">
            @yield('main')
          </div>
        </div>
      </div>



    </body>

    <x-user.footer />

    <x-page-loader/>

    @if(session('alertType'))
    <x-alert-box :alert-type="session('alertType')" :alert-reason="session('alertReason')" :alert-message="session('alertMessage')" />
    @endif

    <script>
      $(document).ready(function() {
    // Check if there are any validation errors
    if($('.is-invalid').length) {
            // Scroll to the first element with an error
            $('html, body').animate({
                scrollTop: $('.is-invalid').first().offset().top - ($(window).height() / 2)
            }, 'smooth');
        }
      });
    </script>
    @stack('script')
</html>
