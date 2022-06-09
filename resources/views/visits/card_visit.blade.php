
<div wire:ignore.self class="modal fade" id="cardVisit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Karta wizyty \ {{ $date_visit }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <table>
              <tr>
                <th>Imię pacjenta</th>
                <td class='text-right'>{{ $firstname }}</td>
              </tr>
              <tr>
                <th>Nazwisko pacjenta</th>
                <td class='text-right'>{{ $name }}</td>
              </tr>
              <tr>
                <th>Imię specjalisty</th>
                <td class='text-right'>{{ $w_firstname }}</td>
              </tr>
              <tr>
                <th>Nazwisko specjalisty</th>
                <td class='text-right'>{{ $w_name }}</td>
              </tr>
              <tr>
                <th>Wygenerowano</th>
                <td class='text-right'>{{ $generated }}</td>
              </tr>
            </table>
          </div>
          <div class="col-6">
            <table>
              <tr>
                <th>Data wizyty</th>
                <td class='text-right'>{{ $date_visit }}</td>
              </tr>
              <tr>
                <th>Nazwa usługi</th>
                <td class='text-right'>{{ $title }}</td>
              </tr>
              <tr>
                <th>Czas trwania wizyty</th>
                <td class='text-right'>{{ $time }} min.</td>
              </tr>
              <tr>
                <th>Koszt wizyty</th>
                <td class='text-right'>{{ $cost }} zł.</td>
              </tr>
              <tr>
                <th>Status wizyty</th>
                <td class='text-right'>
                <?php
                  switch($status) {
                      case 0: echo '<span class="badge badge-danger">Anulowana</span>'; break;
                      case 1: echo '<span class="badge badge-primary">Oczekująca</span>'; break;
                      case 2: echo '<span class="badge badge-danger">Anulowana <br/>przez klienta</span>'; break;
                      case 3: echo '<span class="badge badge-danger">Anulowana <br/>przez pracownika</span>'; break;
                      case 4: echo '<span class="badge badge-success">Zrealizowane</span>'; break;
                      case 5: echo '<span class="badge badge-success">Brak pacjenta <br/>na wizycie</span>'; break;
                  }
                ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
      @else
        <button type="button" wire:click="$emit('statusVisit', '3')" class="btn btn-outline-danger">Anuluj wizytę</button>
        <button type="button" wire:click="$emit('statusVisit', '4')" class="btn btn-outline-success">Wizyta odbyta</button>
        <button type="button" wire:click="$emit('statusVisit', '5')" class="btn btn-outline-primary">Brak pacjenta</button>
      @endif
      </div>
    </div>
  </div>
</div>