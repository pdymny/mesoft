
  

  <section id="hero">

    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(start/img/slide/s1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <div class="mt-n5 mb-5 alert alert-success">Aplikacja na sprzedaż. Kontakt: pdymny896@gmail.com</div>
              <h2 class="animate__animated animate__fadeInDown">Witaj w <span>Mesoft</span></h2>
              <p class="animate__animated animate__fadeInUp">
                Mesoft to system typu SaaS w chmurze dla gabinetów lekarskich, przychodni, klinik, czy szpitali.<br/>
                Zawiera bazę pacjentów, umawianie wizyt, dokumentacje medyczną i przypomnienia SMS oraz e-mail.<br/>
                Zarządzanie gabinetem i kliniką oraz rejestracja pacjentów jeszcze nigdy nie były tak proste!
              </p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto mt-5">Więcej o oprogramowaniu</a>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(start/img/slide/s2.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Przyjazny i intuicyjny interfejs</h2>
              <p class="animate__animated animate__fadeInUp">
                Korzystanie z Mesoft przy wykonywaniu codziennych czynności w gabinetach i klinikach znacząco zwiększa wydajność i wygodę pracy. <br/>
                Z systemu możesz korzystać z każdego sprzętu podłączonego do internetu. <br/>
                Planowanie oraz wyszukiwanie wizyt jest proste i intuicyjne. <br/>
                Pacjenci, wizyty oraz inne dane mogą być wyszukiwani na podstawie dowolnych parametrów np. daty, PESEL-u, email, numeru telefonu itd.
              </p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto mt-5">Więcej o oprogramowaniu</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(start/img/slide/s3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">W szybki sposób umów wizytę</h2>
              <p class="animate__animated animate__fadeInUp">
                Umawianie nowej wizyty dla pacjenta jest banalnie proste i szybkie w realizacji. <br/>
                System automatycznie podpowie wolne terminy, uwzględniając grafik lekarza oraz inne wizyty.<br/>
                Wystarczy potwierdzić informacje i gotowe - wizyta zostanie umówiona. <br/>
              </p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto mt-5">Więcej o oprogramowaniu</a>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Poprzedni</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Następny</span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="about" class="services">
      <div class="container">

        <div class="row">
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-hospital"></i>
              <h4><a href="#">Szybkie przeglądanie pacjentów i dokumentacji</a></h4>
              <p>Pacjentów możesz wyszukać w szybki sposób przy pomocy imienia, nazwiska, numeru pesel, czy innych podanych informacji. Każdy pacjent w serwisie posiada kartę pacjenta. Zawiera ona informacje o pacjencie, historię wizyt oraz dokumentację. Każdy załącznik może zostać pobrany w dowolnym momencie.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="icon-box">
              <i class="icofont-prescription"></i>
              <h4><a href="#">Komunikacja oraz przypomnienia SMS / E-mail</a></h4>
              <p>W oprogramowaniu jest dostępny system do komunikacji z pacjentami.
              Za pomocą tego systemu każdy pacjent jest informowany odpowiednio wcześniej o zbliżającej się wizycie. 
              W przypadku zmian można mu również wysłać odpowiednią informację za pomocą systemu.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-crutch"></i>
              <h4><a href="#">Obsługa wielu pracowników i kont</a></h4>
              <p>W systemie każdy pracownik posiada swoje unikalne konto, które daje dostęp do systemu.
                Dzięki takiemu rozwiązaniu ma łatwy dostęp do wszystkich potrzebnych dla niego funkcji serwisu.
                Wszystkie akcje wykonane przez pracowników są zapisywane.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-doctor"></i>
              <h4><a href="#">Wysokie standardy bezpieczeństwa</a></h4>
              <p>Bezpieczeństwo jest dla nas ważne, dlatego nasza aplikacja została zabezpieczona certyfikatem SSL. Oprócz tego stosujemy zabezpieczenia anty-DDoS i backup wszystkich danych. Stabilnie działające serwery, z których korzystamy, posiadają certyfikaty bezpieczeństwa.</p>
            </div>
          </div>
      </div>
    </section><!-- End Services Section -->

    <section id="xyz" class="about">
      <div class="container text-center">
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg float-none">Skorzystaj z podstawowego pakietu za darmo</a>
      </div>
    </section>

  </main><!-- End #main -->
