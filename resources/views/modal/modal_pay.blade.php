
<div wire:ignore.self class="modal fade" id="modalPay">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Opłać: @if(!empty($invoice)) {{ $invoice['name'] }} @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        @if (session()->has('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
        <div class="row">
          <table class="table">
            <tr>
              <th>Nazwa</th>
              <th>Sztuki</th>
              <th>Cena za sztukę</th>
              <th>Suma netto</th>
              <th>Podatek VAT</th>
              <th>Suma z VAT</th>
            </tr>
          @foreach($invoice_records as $tab)
            <tr>
              <td>{{ $tab['name'] }}</td>
              <td>{{ $tab['unity'] }}</td>
              <td>{{ $tab['pieces'] }} PLN</td>
              <td>{{ $tab['sum'] }} PLN</td>
              <td>{{ round((($tab['sum'] * 23) / 100), 2) }} PLN</td>
              <td>{{ round($tab['sum'] + (($tab['sum'] * 23) / 100), 2) }} PLN</td>
            </tr>
          @endforeach
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ $invoice_sum }} PLN</td>
              <td>{{ round((($invoice_sum * 23) / 100), 2) }} PLN</td>
              <td>{{ round($invoice_sum + (($invoice_sum * 23) / 100), 2) }} PLN</td>
            </tr>
          </table>
        </div>
        <div class="mt-3">
          Faktura zostanie wysłana na e-maila po dokonaniu płatności.
        </div>
      </div>
      <div class="modal-footer">
        @if(!empty($invoice))
        @if($invoice['recommend_id'] == 0)
        <div class="input-group w-50">
          <input type="text" wire:model.defer="code" class="form-control">
          <button type="button" wire:click="saveCode" class="btn btn-outline-primary">Użyj</button>
        </div>
        @endif
        @endif
        <button type="button" wire:click="pay" class="btn btn-outline-primary d-inline">Przejdź do płatności</button>
      </div>
    </div>
  </div>
</div>
