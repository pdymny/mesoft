<div wire:ignore.self id="printSms" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Doładuj sms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
        @foreach($sms as $tab)
          <div class="col-6">
            <div class="card text-center shadow-sm p-2 mb-3 bg-white rounded" style="cursor:pointer;">
              <div class="card-body">
                <label for="switch_sms_{{ $tab['id'] }}">
                  <div class="font-weight-bold" style="font-size:16px;" style="cursor:pointer;">
                    Pakiet {{ $tab['quantity'] }} sms-ów
                  </div>

                  <p class="card-text mt-2" style="cursor:pointer;">
                    Koszt: {{ $tab['cost'] }} zł. + VAT. 
                  </p>
                </label>
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="switch_sms" id="switch_sms_{{ $tab['id'] }}" value="{{ $tab['id'] }}" wire:model="switch_sms">
                </div>
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>
      <div class="modal-footer">
        @if(!empty($data_invoice))
        <button type="button" wire:click="$emit('generateInvoiceSms')" class="btn btn-outline-primary @if(empty($switch_sms)) disabled @endif">
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