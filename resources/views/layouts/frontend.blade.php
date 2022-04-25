<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- csrf token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  {{-- jquery ui --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
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

    {{-- whatsapp chat --}}
    <div class="whatsapp-icon">
      <a href="https://wa.me/+8801764997485?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
        <img src="{{ asset('frontend/assets/images/whatsapp-icon.jpg') }}" 
        alt="whatsapp-icon" height="80px" width="80px">
      </a>
    </div>

    <footer class="footer py-4  ">
        <div class="container text-center">
            <h5>Footer part</h5>
        </div>
      </footer>
  </main>

  <!--   Core JS Files   -->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
{{-- <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script> --}}
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6266daed7b967b11798c6f71/1g1gsecim';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

{{-- jquery ui --}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    var availableTags = [];

    $.ajax({
      method: "GET",
      url: "/product-list",
      success: function(response) {
        startAutocomplete(response);
      }
    });

    function startAutocomplete(availableTags) {
      $( "#search-product" ).autocomplete({
        source: availableTags
      });
    }

</script>

{{-- custom js --}}
<script src="{{ asset('frontend/js/custom.js')}}"></script>
<script src="{{ asset('frontend/js/checkout.js')}}"></script>

  {{-- End core js --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('status'))
<script>
  swal("{{ session('status') }}");
</script>
@endif
@yield('script')
</body>
</html>