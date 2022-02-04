<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('titile')
  </title>
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('frontend/css/bootstrap5.css')}}" rel="stylesheet"/>
  {{-- custome css --}}
  <link id="pagestyle" href="{{ asset('frontend/css/style.css')}}" rel="stylesheet"/>
  {{-- owl carousel --}}
  <link id="pagestyle" href="{{ asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet"/>
  <link id="pagestyle" href="{{ asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet"/>
  {{-- goole font --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  {{-- font awesome --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
</head>

<body class="g-sidenav-show  bg-gray-200">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
      @include('layouts.inc.frontnav')
    <!-- End Navbar -->
    <div class="container py-4">
       @yield('content')
    </div>
    <footer class="footer py-4  ">
        <div class="container text-center">
            <h5>Footer part</h5>
        </div>
      </footer>
  </main>

  <!--   Core JS Files   -->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>

  {{-- End core js --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('status'))
<script>
  swal("{{ session('status') }}");
</script>
@yield('script')
@endif
</body>

</html>