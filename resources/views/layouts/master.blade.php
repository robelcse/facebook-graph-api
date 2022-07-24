<!DOCTYPE html>
<html lang="en">

<head>
  <title>Instagram Graph API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- css plugin strat -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

  <link href="{{asset('public/assets-dashboard/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets-dashboard/css/responsive.css')}}" rel="stylesheet">
  <!-- css plugin end -->

  <style>
    .error-msg {  
      color: red!important;
      font-size: 14px!important;
    }
  </style>
 <style>
    .toast-title{

        font-size: 14px!important;
    }

    .toast-message{
      font-size: 13px!important;
    }
  </style>
</head>

<body>

  <!-- dashboard main start -->
  <section class="dashboard_main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12 col-12 px-0">
          <div class="dashboard-sidebar-wrap">
            <div class="dashboard-logo-wrap">
              <a href="{{ url('/') }}">
                <img src="{{ asset('public/assets-dashboard/images/logo.png') }}" alt="Logo" class="img-fluid">
              </a>
              <a href="#" onclick="openNav()" class="d-md-none">
                <i class="fas fa-bars"></i>
              </a>
            </div>
            <ul class="dashboard-sidebar-menu d-none d-md-flex">

              @if(Auth::check() && Auth::user()->role == 2)
              <!--vendor navigation-->
              <li><a href="{{ url('vendor/dashboard') }}" class="{{ Request::is('vendor/dashboard')  ? ' active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>

              <li><a href="{{ url('vendor/earning') }}" class="{{ Request::is('vendor/earning')  ? ' active' : '' }}"><i class="fas fa-dollar-sign"></i> Earning</a></li>
              <li><a href="{{ url('vendor/appsetting') }}" class="{{ Request::is('vendor/appsetting')  ? ' active' : '' }}"><i class="fas fa-cog"></i> App Setting</a></li>
              <li><a href="{{ url('vendor/profile') }}" class="{{ Request::is('vendor/profile')  ? ' active' : '' }}"><i class="fas fa-user-tie"></i> Profile</a></li>
              <li><a href="{{ url('vendor/payment/request') }}" class="{{ Request::is('vendor/payment/request')  ? ' active' : '' }}"><i class="fas fa-money-bill"></i> Payment Request</a></li>
              
              @endif

              @if(Auth::check() && Auth::user()->role == 1)
              <!--admin navigation-->
              <li><a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard')  ? ' active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
              <li><a href="{{ url('admin/earning') }}" class="{{ Request::is('admin/earning')  ? ' active' : '' }}"><i class="fas fa-dollar-sign"></i> Earning </a></li>
              <li><a href="{{ url('admin/post/price') }}" class="{{ Request::is('admin/post/price')  ? ' active' : '' }}"><i class="fas fa-dollar-sign"></i> Set Post Price </a></li>
              <li><a href="{{ url('admin/payment/request') }}" class="{{ Request::is('admin/payment/request')  ? ' active' : '' }}"><i class="fas fa-money-bill"></i> Payment Request</a></li>
              <li><a href="{{ url('admin/payment/pending') }}" class="{{ Request::is('admin/payment/pending')  ? ' active' : '' }}"><i class="fas fa-money-bill-wave"></i> Pending Payment</a></li>
              @endif


              @if(Auth::check())
              <li>
                <form class="d-flex" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i>Log out</a>
                </form>

              </li>
              @endif

            </ul>

            <!-- mobile menu start -->
            <div class="mobile_menu_wrap d-md-none" id="mySidebar">
              <div class="nav_close">
                <a href="{{url('/')}}">
                  <img src="{{ asset('assets-dashboard/images/logo.png') }}" alt="Logo" class="img-fluid">
                </a>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                  <i class="fas fa-times"></i>
                </a>
              </div>
              <div class="mobile_main_mnu">
                <ul>
                  @if(Auth::check() && Auth::user()->role == 2)
                  <!--vendor navigation-->
                  <li><a href="{{ url('vendor/dashboard') }}" class="{{ Request::is('vendor/dashboard')  ? ' active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>

                  <li><a href="{{ url('vendor/earning') }}" class="{{ Request::is('vendor/earning')  ? ' active' : '' }}"><i class="fas fa-dollar-sign"></i> Earning</a></li>
                  <li><a href="{{ url('vendor/profile') }}" class="{{ Request::is('vendor/profile')  ? ' active' : '' }}"><i class="fas fa-user-tie"></i> Profile</a></li>
                  <li><a href="{{ url('vendor/payment/request') }}" class="{{ Request::is('vendor/payment/request')  ? ' active' : '' }}"><i class="fas fa-money-bill"></i> Payment Request</a></li>
                  <li><a href="{{ url('vendor/profile/update') }}" class="{{ Request::is('vendor/profile/update')  ? ' active' : '' }}"><i class="fas fa-user-plus"></i> Update Profile</a></li>
                  @endif

                  @if(Auth::check() && Auth::user()->role == 1)
                  <!--admin navigation-->
                  <li><a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard')  ? ' active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
                  <li><a href="{{ url('admin/earning') }}" class="{{ Request::is('admin/earning')  ? ' active' : '' }}"><i class="fas fa-dollar-sign"></i> Earning</a></li>
                  <li><a href="{{ url('admin/payment/request') }}" class="{{ Request::is('admin/payment/request')  ? ' active' : '' }}"><i class="fas fa-money-bill"></i> Payment Request</a></li>
                  <li><a href="{{ url('admin/payment/pending') }}" class="{{ Request::is('admin/payment/pending')  ? ' active' : '' }}"><i class="fas fa-money-bill-wave"></i> Pending Payment</a></li>
                  @endif
                </ul>
              </div>
              <div class="mobile_menu_bttn">
                @if(Auth::check())
                <form class="d-flex" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                          this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i>Log out</a>
                </form>
                @endif
              </div>
            </div>
            <!-- mobile menu end -->
          </div>
        </div>

        <div class="col-lg-10 col-md-9 col-sm-12 col-12 px-0">
          <div class="dashboard-header-wrap">
            @if(Auth::check())

            <h6>Welcome! Mr. <span>{{ Auth::user()->user_name }}</span></h6>

            <form class="d-flex" method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              this.closest('form').submit();"><i data-feather="log-out"></i> <i class="fas fa-sign-out-alt"></i> Log out</a>
            </form>
            @endif

          </div>
          <div class="dashboard-body-wrap">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- dashboard main end -->


  <!-- js plugin start -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="{{asset('public/assets-dashboard/js/custom.js')}}"></script>
  <!-- js plugin end -->

  @if(Session::has('success'))
  <script>
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.success('{{ Session::get('success') }}', 'Success')
  </script>
  @endif
  @if(Session::has('error'))
  <script>
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.error('{{ Session::get('error') }}', 'Error')
  </script>
  @endif
  @if(Session::has('info'))
  <script>
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.info('{{ Session::get('info') }}', 'Info')
  </script>
  @endif
  @if(Session::has('warning'))
  <script>
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.warning('{{ Session::get('warning') }}', 'Warning')
  </script>
  @endif
  <!-----------------//----------------->

</body>

</html>