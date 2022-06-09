<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Cennik</h2>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

    	<select class="form-control mb-3 w-50" wire:model.defer="time" wire:click="$emit('calcCennik')">
    		<option value="12">12 miesięczny okres płatności</option>
    		<option value="6">6 miesięczny okres płatności</option>
    		<option value="3">3 miesięczny okres płatności</option>
    		<option value="1">1 miesięczny okres płatności</option>
    	</select>

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="box">
              <h3>Darmowy</h3>
              <h4>0 <sup><small>PLN</small></sup><span>/ miesiąc</span></h4>
              <ul>
                <li>Limit kont: <b>1</b></li>
                <li>Limit pracowników: <b>1</b></li>
                <li>Limit wizyt w miesiacu: <b>30</b></li>
                <li>Limit pojemności: <b>100 MB</b></li>
                <li>Miesięcznie SMS: <b>Brak</b></li>
                <li>Miesięcznie e-mail: <b>Brak</b></li>
                <li>Reklamy: <b>Tak</b></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
            <div class="box featured">
              <h3>Mini</h3>
              <h4>{{ $pack_mini }} <sup><small>PLN</small></sup><span>/ miesiąc</span></h4>
              <ul>
                <li>Limit kont: <b>5</b></li>
                <li>Limit pracowników: <b>5</b></li>
                <li>Limit wizyt w miesiacu: <b>Brak</b></li>
                <li>Limit pojemności: <b>2 GB</b></li>
                <li>Miesięcznie SMS: <b>50 sztuk</b></li>
                <li>Miesięcznie e-mail: <b>200 sztuk</b></li>
                <li>Reklamy: <b>Nie</b></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Medium</h3>
              <h4>{{ $pack_medium }} <sup><small>PLN</small></sup><span>/ miesiąc</span></h4>
              <ul>
                <li>Limit kont: <b>10</b></li>
                <li>Limit pracowników: <b>10</b></li>
                <li>Limit wizyt w miesiacu: <b>Brak</b></li>
                <li>Limit pojemności: <b>5 GB</b></li>
                <li>Miesięcznie SMS: <b>100 sztuk</b></li>
                <li>Miesięcznie e-mail: <b>500 sztuk</b></li>
                <li>Reklamy: <b>Nie</b></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <span class="advanced">Premium</span>
              <h3>Maxi</h3>
              <h4>{{ $pack_maxi }} <sup><small>PLN</small></sup><span>/ miesiąc</span></h4>
              <ul>
                <li>Limit kont: <b>Brak</b></li>
                <li>Limit pracowników: <b>Brak</b></li>
                <li>Limit wizyt w miesiacu: <b>Brak</b></li>
                <li>Limit pojemności: <b>20 GB</b></li>
                <li>Miesięcznie SMS: <b>200 sztuk</b></li>
                <li>Miesięcznie e-mail: <b>1000 sztuk</b></li>
                <li>Reklamy: <b>Nie</b></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="mt-3">Kwoty podane w cennach netto.</div>
    </div>
</section>

<section id="pricing" class="pricing" style="margin-top:-50px;">
    <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-12">
            <div class="box">
              <h3>Dodatkowe SMS</h3>
              <h4>0,15 <sup><small>PLN</small></sup><span>/ sztuka</span></h4>
            </div>
          </div>

          <div class="col-lg-6 col-md-12">
            <div class="box">
              <h3>Dodatkowe e-maile</h3>
              <h4>5 <sup><small>PLN</small></sup><span>/ 1000 sztuk</span></h4>
            </div>
          </div>

         </div>

         <div class="mt-3">Kwoty podane w cennach netto.</div>
      </div>
   </section>

    <section id="about" class="about">
      <div class="container text-center">
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg float-none">Skorzystaj z podstawowego pakietu za darmo</a>
      </div>
    </section>

  </main><!-- End #main -->