<!DOCTYPE html>
<html lang="en">

<head>
  <title>Instagram Graph API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- css plugin strat -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

  <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/css/responsive.css')}}" rel="stylesheet">
  <!-- css plugin end -->

   <!--toastr notification css-->
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   
  <style>
    .toast-title{

        font-size: 14px!important;
    }

    .toast-message{
      font-size: 13px!important;
    }
  </style>
   <style>
    .error-msg {  
      color: red!important;
      font-size: 14px!important;
    }
  </style>
   

   <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap" rel="stylesheet">


   <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/main.css') }}">
   <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/custom.css') }}">
</head>

<body>

  <!-- header section start -->
  <div class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-md">
        <div class="container">
          <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('public/assets/images/logo.png')}}" alt="Logo" class="img-fluid">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">

              @if(!Auth::check())
              <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
              @endif

              @if(Auth::check() && Auth::user()->role == 2)
              <!--vendor navigation--> 
              <li class="nav-item"><a class="nav-link" href="{{ url('vendor/dashboard') }}">Dashboard</a></li> 
              @endif

              @if(Auth::check() && Auth::user()->role == 1)
              <!--admin navigation-->
              <li class="nav-item"><a class="nav-link" href="{{ url('admin/dashboard') }}">Dashboard</a></li> 
              @endif
            </ul>

            @if(Auth::check())
            <form class="d-flex" role="search" method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn" type="button"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                      this.closest('form').submit();"><i data-feather="log-out"></i>Log out</a></button>
            </form>
            @endif

            @if(!Auth::check())
            <form class="d-flex hero-bttn">
              <a href="{{ url('register') }}">Register</a> 
               <a href="{{ url('login') }}">Login</a> 
            </form>
            @endif
          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- header section end -->

  @yield('content')

  <!-- js plugin start -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  
  <script src="{{asset('public/assets/js/custom.js')}}"></script>
  <!-- js plugin end -->
  


  
  <!-----------------js for toastr notification----------------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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


  <!--multiple image upload pulgin dependency-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{ asset('public/assets/plugins/js/image-uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/plugins/js/app.js') }}"></script>

</body>

</html>