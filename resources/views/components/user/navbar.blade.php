<x-main-nav>
    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('user.home') ? 'active shadow border border-1' : '' }}" href="{{ route('user.home') }}">
            <i class="bi bi-house-fill me-2"></i>Home
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('user.profile') ? 'active shadow border border-1' : '' }}" href="{{ route('user.profile') }}">
            <i class="bi bi-person-fill-gear me-2"></i>Profile
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('admission.apply', 'user.applied') ? 'active shadow border border-1' : '' }}" data-bs-toggle="collapse" href="#userAdmissionsMenu" role="button" aria-expanded="false" aria-controls="userAdmissionsMenu">
            <i class="bi bi-pencil-square me-2"></i> Admissions <i class="bi bi-chevron-compact-down"></i>
        </a>
        <div class="collapse" id="userAdmissionsMenu">
            <ul class="list-unstyled ms-3">
                <li>
                    <a class="nav-link {{ Route::is('admission.apply') ? 'active shadow border border-1' : '' }}" href="{{ route('admission.apply') }}">
                        <i class="bi bi-pencil-fill me-2"></i> Apply
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Route::is('user.applied') ? 'active shadow border border-1' : '' }}" href="{{ route('user.applied') }}">
                        <i class="bi bi-check-circle-fill me-2"></i> Already Applied
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item w-100">
        <a href="{{ route('user.account') }}" class="nav-link {{ Route::is('user.account') ? 'active shadow border border-1' : '' }}">
            <i class="bi bi-gear-wide-connected me-2"></i>Account
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('user.help', 'user.about') ? 'active shadow border border-1 ' : '' }}" data-bs-toggle="collapse" href="#userMoreMenu" role="button" aria-expanded="false" aria-controls="userMoreMenu">
            <i class="bi bi-list"></i> More <i class="bi bi-chevron-compact-down"></i>
        </a>
        <div class="collapse " id="userMoreMenu">
            <ul class="list-unstyled ms-3">
                <li>
                    <a class="nav-link {{ Route::is('user.help') ? 'active shadow border border-1' : '' }}" href="{{ route('user.help') }}">
                        <i class="bi bi-telephone me-2"></i>Contact Us
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Route::is('user.about') ? 'active shadow border border-1' : '' }}" href="{{ route('user.about') }}">
                        <i class="bi bi-info-circle me-2"></i>About Us
                    </a>
                </li>
            </ul>
        </div>
    </li>
</x-main-nav>
