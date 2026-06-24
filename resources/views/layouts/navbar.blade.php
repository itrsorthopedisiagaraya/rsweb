<!--  Header Start -->
<header class="app-header" style="z-index: 999;">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
      </ul>
      <div class="navbar-collapse justify-content-start px-0" id="navbarNav">
        <ul class="navbar-nav justify-content-start">
          <div class="btn-group dropstart">
            <a class="btn btn-success btn-sm" href="{{ route('home') }}">
              <span><i class="fa fa-eye"></i></span>
              &nbsp; Company Profile
            </a>
          </div>
        </ul>
      </div>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <div class="btn-group dropstart">
            <a class="dropdown-toggle text-dark" role="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="flag-icon flag-icon-{{ app()->getLocale() == 'id' ? 'id' : 'us' }} flag-icon-squared"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <a href="{{ route('lang', ['language' => 'id']) }}" class="dropdown-item">
                <span class="flag-icon flag-icon-id flag-icon-squared"></span>
                &ensp;{{ trans('localization.id') }}
              </a>
              <a href="{{ route('lang', ['language' => 'us']) }}" class="dropdown-item">
                <span class="flag-icon flag-icon-us flag-icon-squared"></span>
                &ensp;{{ trans('localization.en') }}
              </a>
            </ul>
          </div>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="{{ asset('') }}assets/images/profile/user.png" alt="" width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">Profile</p>
                </a>
                <a href="{{ route('signout') }}" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-logout fs-6"></i>
                    <p class="mb-0 fs-3">Logout</p>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
</header>
<!--  Header End -->