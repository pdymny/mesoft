
<div wire:ignore.self class="modal fade" id="modalInvoice">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Wybierz pakiet
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        @foreach($pack as $tab)
          <div class="col-4">
            <div class="card text-center shadow-sm p-2 mb-3 bg-white rounded" style="cursor:pointer;">
              <div class="card-body">
                <label for="switch_pack_{{ $tab['id'] }}">
                  <ul class="list-group" style="cursor:pointer;">
                    <li class="list-group-item font-bold list-group-item-primary">{{ $tab['name'] }}</li>
                    <li class="list-group-item">
                      Limit kont: <b>@if($tab['account'] == 0) Brak limitu @else {{ $tab['account'] }} @endif</b>
                    </li>
                    <li class="list-group-item">
                      Limit pracowników: <b>@if($tab['workers'] == 0) Brak limitu @else {{ $tab['workers'] }} @endif</b>
                    </li>
                    <li class="list-group-item">Limit wizyt: <b>{{ $tab['visit'] }}</b></li>
                    <li class="list-group-item">Limit pojemności: <b>{{ $tab['data'] }}</b></li>
                    <li class="list-group-item">Miesięcznie SMS-ów: <b>{{ $tab['sms'] }}</b> szt.</li>
                    <li class="list-group-item">Miesięcznie e-maili: <b>{{ $tab['email'] }}</b> szt.</li>
                  </ul>
                </label>
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="switch_pack" id="switch_pack_{{ $tab['id'] }}" value="{{ $tab['id'] }}" wire:model="switch_pack" wire:click="calcPack">
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row">
        <div class="col-4">
          <select class="form-control" wire:model="time" id="time" wire:click="calcPack" value="{{ $time }}">
            <option value="12">Pakiet na 12 miesięcy</option>
            <option value="6">Pakiet na 6 miesięcy</option>
            <option value="3">Pakiet na 3 miesięce</option>
            <option value="1">Pakiet na 1 miesięc</option>
          </select>
        </div>
        <div class="col-8">
          <table class="table">
            <tr>
              <th>Ilość miesięcy</th>
              <th>Cena za misieąc</th>
              <th>Suma netto</th>
              <th>Podatek VAT</th>
              <th>Suma brutto</th>
            </tr>
            <tr>
                <td>{{ $time }}</td>
                <td>{{ $cost_month }} zł.</td>
                <td>{{ $suma }} zł.</td>
                <td>{{ $vat }} zł.</td>
                <td>{{ $suma_vat }} zł.</td>
              </tr>
            </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        @if(!empty($data_invoice))
        <button type="button" wire:click="$emit('generateInvoicePack')" class="btn btn-outline-primary @if($suma == 0) disabled @endif">
          Wybieram i przechodzę do płatności
        </button>
        @else
        <button type="button" class="btn btn-outline-danger disabled">
          Uzupełnij dane do faktury
        </button>
        @endif
      </div>
    </div>
  </div>
</div>