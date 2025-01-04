<x-main-nav>
    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('admin.home') ? 'active shadow border border-1' : '' }}" href="{{ route('admin.home') }}">
            <i class="bi bi-house-fill me-2"></i>Home
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('department.index') ? 'active shadow border border-1' : '' }}" href="{{ route('department.index') }}">
            <i class="bi bi-buildings me-2"></i>Departments
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('program.index') ? 'active shadow border border-1' : '' }}" href="{{ route('program.index') }}">
            <i class="bi bi-boxes me-2"></i>Programs
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('degree.index') ? 'active shadow border border-1' : '' }}" href="{{ route('degree.index') }}">
            <i class="bi bi-bounding-box me-2"></i>Degrees
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('bank.index') ? 'active shadow border border-1' : '' }}" href="{{ route('bank.index') }}">
            <i class="bi bi-bank me-2"></i>Banks
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('admission.index', 'records.applicants','export.index') ? 'active shadow border border-1 ' : '' }}" data-bs-toggle="collapse" href="#admissionMoreMenu" role="button" aria-expanded="false" aria-controls="admissionMoreMenu">
            <i class="bi bi-folder-plus"></i> Admissions <i class="bi bi-chevron-compact-down"></i>
        </a>
        <div class="collapse " id="admissionMoreMenu">
            <ul class="list-unstyled ms-3">
                <li>
                    <a class="nav-link {{ Route::is('admission.index') ? 'active shadow border border-1' : '' }}" href="{{ route('admission.index') }}">
                        <i class="bi bi-database-add me-2"></i>Manage
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ Route::is('records.applicants') ? 'active shadow border border-1' : '' }}" href="{{ route('records.applicants') }}">
                        <i class="bi bi-pen me-2"></i>Applications
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ Route::is('export.index') ? 'active shadow border border-1' : '' }}" href="{{ route('export.index') }}">
                        <i class="bi bi-download me-2"></i>Downloads
                    </a>
                </li>

            </ul>
        </div>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('user.index') ? 'active shadow border border-1' : '' }}" href="{{ route('user.index') }}">
            <i class="bi bi-people me-2"></i>Users
        </a>
    </li>



    <li class="nav-item w-100">
        <a href="{{ route('admin.account') }}" class="nav-link {{ Route::is('admin.account') ? 'active shadow border border-1 ' : '' }}">
            <i class="bi bi-gear-wide-connected me-2"></i>Account
        </a>
    </li>

    <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('admin.help', 'admin.about') ? 'active shadow border border-1 ' : '' }}" data-bs-toggle="collapse" href="#adminMoreMenu" role="button" aria-expanded="false" aria-controls="adminMoreMenu">
            <i class="bi bi-list"></i> More <i class="bi bi-chevron-compact-down"></i>
        </a>
        <div class="collapse " id="adminMoreMenu">
            <ul class="list-unstyled ms-3">
                <li>
                    <a class="nav-link {{ Route::is('admin.help') ? 'active shadow border border-1' : '' }}" href="{{ route('admin.help') }}">
                        <i class="bi bi-telephone me-2"></i>Contact Us
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Route::is('admin.about') ? 'active shadow border border-1' : '' }}" href="{{ route('admin.about') }}">
                        <i class="bi bi-info-circle me-2"></i>About Us
                    </a>
                </li>
            </ul>
        </div>
    </li>

</x-main-nav>
