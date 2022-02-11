<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
      {{-- side nav header --}}
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="" target="_blank">
        <img src="{{ asset('admin/assets/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Ecommerce</span>
      </a>
    </div>
    {{-- end side nav header --}}
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard') ? 'active' : ''}}" href="{{ url('dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <span class="nav-link-text ms-1">Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('categories') ? 'active' : ''}}" href="{{route('category.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <span class="nav-link-text ms-1">Categories</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('products') ? 'active' : ''}}" href="{{route('products.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <span class="nav-link-text ms-1">Products</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </aside>