<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css')  }}">
  <link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"/>
  <style>
    .sidebar-nav li .submenu{ 
      list-style: none; 
      margin: 0; 
      padding: 0; 
      padding-left: 1.3rem;  
      padding-right: 1rem;
      z-index: 99999;
    }
    .loader-wrapper {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, .3);
      z-index: 997;
    }
    .loader-button {
      border: 3px solid #f3f3f3; /* Light grey */
      border-top: 3px solid rgba(0, 0, 0, 0); /* Blue */
      border-radius: 50%;
      width: 15px;
      height: 15px;
      animation: spin 1.5s linear infinite;
    }
    .loader-window {
      border: 10px solid #1077b7; /* Light grey */
      border-top: 10px solid rgba(0, 0, 0, 0); /* Blue */
      border-radius: 50%;
      width: 80px;
      height: 80px;
      animation: spin 1.5s linear infinite;
      z-index: 998;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <!--  Main wrapper -->
    <div class="body-wrapper">
      @include('layouts.navbar')
      <div class="container-fluid" style="background-color: rgb(239, 239, 239); min-height:100vh;">
        <!--  Row 1 -->
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
          <ol class="breadcrumb">
            @yield('breadcrumb')
          </ol>
        </nav>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script>
    // vanilla script
    document.addEventListener("DOMContentLoaded", function(){
      document.querySelectorAll('.sidebar-nav .sidebar-link').forEach(function(element){
        
        element.addEventListener('click', function (e) {

          let nextEl = element.nextElementSibling;
          let parentEl  = element.parentElement;	

            if(nextEl) {
                e.preventDefault();	
                let mycollapse = new bootstrap.Collapse(nextEl);
                
                if(nextEl.classList.contains('show')){
                  mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                      new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
      }) // forEach
    }); 

    $(document).ready(function() {
      @if($message = Session::get('message'))
        Swal.fire({
          icon: "success",
          text: "{{ $message }}",
          showConfirmButton: true
        });
      @endif
    });

    $('input').attr('autocomplete', 'off');
    // DOMContentLoaded  end

    // jquery script
    // get all table and add css
    // $(document).ready(function () {
    //   $.each($('.__datatables'), function (idx, val) { 
    //     // add data table
    //     $(val).DataTable({
    //       "scrollX": true,
    //     });
    //   });
    // });
  </script>
  @yield('script')
</body>
</html>
        
  