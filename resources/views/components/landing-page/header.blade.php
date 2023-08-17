<header class="site-header" id="header">
  <nav class="navbar navbar-expand-xl transparent-bg static-nav">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('static-image/logo-no-bg.png') }}" alt="logo" class="logo-default"> 
        <!-- logo-with-transparent-bg.png -->
      </a> &nbsp;&nbsp; <a class="whitecolor"><h3 class="font-xlight d-none d-md-block header-title"> College Prep System </h3></a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('signup')}}" >Sign Up Free</a>
          </li>
          <li class="nav-item">
            <a class="nav-link about-content" href="#" >Prep System</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tutoring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Admissions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('simple-pricing') }}">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('signin')}}">Sign in</a>
          </li>
        </ul>
      </div>
    </div>
    <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
      <span></span> <span></span> <span></span>
    </a>
  </nav>
  <div class="side-menu gradient-bg">
    <div class="overlay"></div>
    <div class="inner-wrapper">
      <span class="btn-close btn-close-no-padding" id="btn_sideNavClose"><i></i><i></i></span>
      <nav class="side-nav w-100">
        <a class="whitecolor"><h3 class="font-xlight d-block d-sm-none"> College Prep System </h3></a>
        <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link" href="{{route('signin')}}">Sign in</a>
          </li>
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link" href="{{route('signup')}}" >Sign Up Free</a>
          </li>
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link about-content" href="#" >Prep System</a>
          </li>
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link" href="#">Tutoring</a>
          </li>
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link" href="#">Admissions</a>
          </li>
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link" href="{{ route('simple-pricing') }}">Pricing</a>
          </li>
          <!-- Default Fields -->
          <li class="nav-item">
            <a class="nav-link" href="#">Results</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Student Success Stories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Testimonials</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Universities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <div id="close_side_menu" class="tooltip tooltipstered" style="display: none;"></div>
</header>