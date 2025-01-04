  {{-- Header Starts --}}
  <header id="header" style="background-image: url('{{asset(config('app.header'))}}')">
    <div class="container-fluid" id="header-container">
     <div class="row">
         <div class="col-12 p-2 col-md-3  text-center">
             <img src="{{asset( config('app.logo'))}}" alt="" class="img-fluid bg-secondary-subtle rounded-4" style="max-width: 120px">
             <h5>{{config('app.fullname')}}</h5>
         </div>
         @php
            $dashboardRoute='#';
         @endphp
        @auth
            @php
                // Map roles to their respective dashboard routes
                $roleDashboardRoutes = [
                    'admin' => route('admin.home'),
                    // 'clerk' => route('clerk.home'),
                    // 'hod' => route('hod.home'),
                    // 'faculty' => route('faculty.home'),
                    'user' => route('user.home'),
                ];

                // Get the dashboard route based on the user's first role
                $dashboardRoute = $roleDashboardRoutes[auth()->user()->roles->first()->name ?? 'user'] ?? route('user.home');
            @endphp
        @else
        @endauth



         <div class="col-12 col-md-8  d-flex justify-content-end align-items-center">
            @auth
            <div class="dropdown">
                <img src="{{ isset(Auth::user()->image->path) ? asset('storage/'.Auth::user()->image->path) : asset('storage/images/logo/person.png') }}" height="30px" width="30px" alt="" class="img-fluid rounded-5 bg-light">
                <button class="btn dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                  {{Auth::user()->name ?? 'Guest'}}
                </button>
                   <ul class="dropdown-menu">
                       <li><a href="{{ $dashboardRoute }}" class="dropdown-item" type="button"><i class="bi bi-house-fill"></i> Home</a></li>
                       {{-- <li><a href="{{route('user.account')}}" class="dropdown-item" type="button"><i class="bi bi-gear-wide-connected"></i> Account</a></li> --}}
                       <li><hr class="dropdown-divider"></li>
                       <form action="{{route('logout')}}" method="POST">
                           @csrf
                           @method('POST')
                           <li><button  class="dropdown-item text-center text-danger" type="submit"><i class="bi bi-box-arrow-right"> Logout</i></button></li>
                       </form>

                   </ul>
               </div>
            @endauth

            @guest

            @if (Route::has('login'))
                <nav class="nav justify-content-center">
                    @auth
                        <a href="{{ $dashboardRoute }}" class="btn btn-lg btn-primary rounded-0 text-white nav-link"><b>Dashboard</b></a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary rounded-0 text-white nav-link  border-end"><b>Log in</b></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-lg btn-primary text-white rounded-0  nav-link"><b>Register</b></a>
                        @endif
                    @endauth
                </nav>

            @endif

            @endguest

         </div>
     </div>
    </div>
 </header>
 {{-- Header Ends --}}
