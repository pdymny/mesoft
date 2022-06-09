
<div wire:ignore.self class="modal fade" id="editInvoice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Płatność: @if($invoice) {{ $invoice['name'] }} @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
      @if($invoice)
      <div class="row">
        <div class="col-6">

          <table style="width:100%;">
            <tr>
              <th>Nazwa</th>
              <td>{{ $settings->name }}</td>
            </tr>
            <tr>
              <th>NIP</th>
              <td>{{ $settings->nip }}</td>
            </tr>
            <tr>
              <th>REGON</th>
              <td>{{ $settings->regon }}</td>
            </tr>
            <tr>
              <th>Miasto</th>
              <td>{{ $settings->city }}</td>
            </tr>
            <tr>
              <th>Kod pocztowy</th>
              <td>{{ $settings->code }}</td>
            </tr>
            <tr>
              <th>Ulica</th>
              <td>{{ $settings->street }}</td>
            </tr>
            <tr>
              <th>Numer</th>
              <td>{{ $settings->number }}</td>
            </tr>
          </table>
        </div>
        <div class="col-6">
          <x-jet-label for="name" value="{{ __('Nazwa płatności') }}"/>
          <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
          <x-jet-input-error for="name" class="mt-2" />

          <x-jet-label for="status" value="{{ __('Status') }}" class="mt-2"/>
          <select class="form-control" wire:model.defer="status" id="status">
            <option value="0">Anulowana</option>
            <option value="1">Do opłacenia</option>
            <option value="2">W trakcie</option>
            <option value="3">Opłacona</option>
            <option value="4">Zakończona. Faktura wysłana.</option>
          </select>
          <x-jet-input-error for="status" class="mt-2" />
        </div>
      </div>
      @endif
      </div>
      <div class="modal-footer">
        <button wire:click="saveInvoice" class="btn btn-outline-primary">Zapisz</button>

      </div>
    </div>
  </div>
</div>
