<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{asset('bs5/bootstrap.min.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bs5/bootstrap.bundle.min.js')}}"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/cloudfare.css') }}"> -->

</head>
<body>

  <!-- <div id="preloader"></div> -->

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6b0b70;">
      <div class="container">
        <div class="logo">
            <img src="{{asset('')}}img/logo.jpg" class="img-fluid" style="max-width: 60px">
        </div>
        <a class="navbar-brand" style="margin-left:20px; font-weight:bold; color: #F5F5F5" href="{{url('/')}}">Hotel Del Luna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{url('page/about-us')}}">About</a>
            <a class="nav-link" aria-current="page" href="#services">Services</a>
            <a class="nav-link" href="#gallery">Gallery</a>
            @if(Session::has('guestlogin'))
            <a class="nav-link" href="{{url('guest/add-testimonial')}}">Add Testimonial</a>
            <a class="nav-link" href="{{url('logout')}}">Logout</a>
            <a class="nav-link btn btn-sm" href="{{url('reservation')}}" style="background-color: initial; margin-top: 0rem" onmouseover="this.style.backgroundColor='#4169E1';" onmouseout="this.style.backgroundColor='initial';">Reservation</a>
            @else

            <a class="nav-link" href="{{url('login')}}">Login</a>
            <a class="nav-link" href="{{url('register')}}">Register</a>
            <a class="nav-link btn btn-sm" href="{{url('login')}}" style="background-color: initial; margin-top: 0rem" onmouseover="this.style.backgroundColor='#B8860B';" onmouseout="this.style.backgroundColor='initial';">Reservation</a>
            @endif
          </div>
        </div>
      </div>
    </nav>
</div>

    <main>
        @yield('content')
    </main>

<!-- <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{asset('')}}js/script.js"></script> -->
</body>
</html>
