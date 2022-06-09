<div id="printPack" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aktualny pakiet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table m-2 text-left">
          <tr>
            <th>Nazwa pakietu</th>
            <td>{{ $name_pack }}</td>
          </tr>
          <tr>
            <th>Koniec pakietu</th>
            <td>
              @if(empty($user->currentTeam->pack_term))
                Bezterminowy
              @else
                {{ $user->currentTeam->pack_term }}
              @endif
            </td>
          </tr>
          <tr>
            <th>Pracownicy</th>
            <td>{{ $worker }} / {{ $pack['work'] }}</td>
          </tr>
          <tr>
            <th>Wizyty</th>
            <td>{{ $visit }} / {{ $pack['visit'] }}</td>
          </tr>
          <tr>
            <th>Pojemność</th>
            <td>{{ $document }} / {{ $pack['data'] }}</td>
          </tr>
          <tr>
            <th>Konta</th>
            <td>{{ $account }} / {{ $pack['account'] }}</td>
          </tr>
          <tr>
            <th>Reklamy</th>
            <td>
            @if($name_pack == 'Darmowy')
            Tak
            @else
            Nie
            @endif
            </td>
          </tr>
          <tr>
            <th>Pakiety miesięczne SMS</th>
            <td>{{ $pack['sms'] }} sztuk</td>
          </tr>
          <tr>
            <th>Pakiety miesięczne E-mail</th>
            <td>{{ $pack['email'] }} sztuk</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <a href="{{ url('payments') }}" type="button" class="btn btn-outline-primary">Przedłuż pakiet</a>
      </div>
    </div>
  </div>
</div>