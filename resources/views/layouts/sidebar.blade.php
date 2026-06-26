<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div class="logo-wrapper d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('assets/images/logos/favicon.png') }}" width="80" alt="logos">
                <img src="{{ asset('assets/images/logos/logo-name.png') }}" width="200" alt="logos">
            </div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer mt-3" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar pb-5" data-simplebar="">
            <ul id="sidebarnav">

                @foreach ($menus as $menu)
                    <x-sidebar.menu-item :menu="$menu" />
                @endforeach

            </ul>
            <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
          <div class="d-flex">
            <div class="unlimited-access-title me-3">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
              <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
            </div>
            <div class="unlimited-access-img">
              <img src="../assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
            </div>
          </div>
        </div> -->
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
