<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mesoft - Oprogramowanie dla Twojej przychodni.</title>
  <meta content="Mesoft - Oprogramowanie dla Twojej przychodni." name="description">
  <meta content="oprogramoanie, medycyna, wizyta, mesoft, dymcode, przychodnia" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('start/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('start/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

  <link href="{{ asset('start/css/style.css') }}" rel="stylesheet">

  @livewireStyles

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>

  <script data-ad-client="ca-pub-3055633283866566" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M687H81D8C"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-M687H81D8C');
  </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

     <!-- <h1 class="logo"><a href="">Mesoft</a></h1>-->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{ route('start') }}" class="logo w-50">
        <img src="mesoft-logo.png" alt="" class="img-fluid d-inline">
        <h1 class="logo d-inline ml-2">Mesoft</h1>
        </a>

      <nav class="nav-menu d-none d-lg-block">

        <ul>
          <li><a href="{{ route('start') }}">Strona Główna</a></li>
          <li><a href="{{ route('funkcje') }}">Funkcje</a></li>
          <li><a href="{{ route('cennik') }}">Cennik</a></li>
          <li><a href="{{ route('kontakt') }}">Kontakt</a></li>
      </ul>

  </nav><!-- .nav-menu -->

  @if (Route::has('login'))
  <div class="float-right" style="width:100%;">
    @auth
    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary float-right">
        Witaj {{ Auth::user()->firstname }} {{ Auth::user()->name }}, Przejdź do pulpitu
    </a>
    @else
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="btn btn-outline-primary float-right">Załóż konto</a>
    @endif

    <a href="{{ route('login') }}" class="btn btn-outline-primary float-right mr-2">Zaloguj się</a>
    @endif
</div>
@endif

</div>
</header><!-- End Header -->

<body>
    {{ $slot }}
</body>
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Mesoft</h3>
              <p>

            </p>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 footer-links">
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('start') }}">Strona Główna</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('funkcje') }}">Funkcje</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('cennik') }}">Cennik</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('kontakt') }}">Kontakt</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('pomoc') }}">Pomoc</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('regulamin') }}">Regulamin</a></li>
      </ul>
  </div>

  <div class="col-lg-3 col-md-6 footer-links">
    <ul>
      <li><i class="bx bx-chevron-right"></i> <a href="{{ route('login') }}">Panel logowania</a></li>
      <li><i class="bx bx-chevron-right"></i> <a href="{{ route('register') }}">Panel rejestracji</a></li>
      <li><i class="bx bx-chevron-right"></i> <a href="{{ route('password.request') }}">Przywracanie hasła</a></li>

  </ul>
</div>

<div class="col-lg-4 col-md-6 footer-newsletter">
    <div class="social-links mt-3">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
    </div>

</div>

</div>
</div>
</div>

<div class="container">
  <div class="copyright">
    &copy; 2021 Copyright <strong><span>Mesoft</span></strong>.
</div>
</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('start/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('start/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('start/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('start/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('start/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('start/vendor/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('start/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('start/vendor/owl.carousel/owl.carousel.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('start/js/main.js') }}"></script>

@livewireScripts
</body>

</html>
