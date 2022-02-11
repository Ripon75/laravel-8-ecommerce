<!DOCTYPE html>
<html lang="en">

<head>
 @include('layouts.inc.css')
</head>

<body class="g-sidenav-show  bg-gray-200">
  
  {{-- start sidebar --}}
    @include('layouts.inc.sidebar')
  {{-- end sidebar --}}

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
      @include('layouts.inc.navbar')
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
 
  {{-- setting part --}}
  @include('layouts.inc.setting')
  {{-- end setting --}}

  <!--   Core JS Files   -->
    @include('layouts.inc.js')
  {{-- End core css --}}
</body>

</html>