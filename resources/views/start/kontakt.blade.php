<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Kontakt</h2>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
      	<!--
        <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
        </div>
		-->
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Firma:</h4>
                <p>xxx</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>E-mail:</h4>
                <p>{{ $where }}</p>
              </div>

              <div class="phone">
                <i class="icofont-info"></i>
                <h4>NIP:</h4>
                <p>5592000000</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Imię" data-rule="minlen:4" wire:model="name"/>
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" data-rule="email" wire:model="email"/>
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Temat" data-rule="minlen:4" wire:model="subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" wire:model="message" placeholder="Treść wiadomości"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                @if($send == 1)
                  <div class="sent-message">Wysłano wiadomość.</div>
                @endif
              </div>
              <div class="text-center"><button class="btn btn-outline-primary" wire:click="send">Wyślij wiadomość</button></div>
 
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
