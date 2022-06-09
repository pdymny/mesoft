
<div wire:ignore.self class="modal fade" id="allSalon">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Salon: @if($team) {{ $team['name'] }} @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
      @if($team)

        <x-jet-label for="pack" value="{{ __('Pakiet') }}"/>
        <select class="form-control" wire:model.defer="pack" id="pack">
          <option value="0">Darmowy</option>
          <option value="1">Mini</option>
          <option value="2">Medium</option>
          <option value="3">Maxi</option>
        </select>
        <x-jet-input-error for="pack" class="mt-2" />

        <x-jet-label for="term" value="{{ __('Termin pakietu') }}" class="mt-2"/>
        <x-jet-input id="term" type="datetime" class="mt-1 block w-full" wire:model.defer="term" />
        <x-jet-input-error for="term" class="mt-2" />

        <x-jet-label for="sms" value="{{ __('Ilość sms') }}" class="mt-2"/>
        <x-jet-input id="sms" type="number" class="mt-1 block w-full" wire:model.defer="sms" />
        <x-jet-input-error for="sms" class="mt-2" />

        <x-jet-label for="email" value="{{ __('Ilość e-mail') }}" class="mt-2"/>
        <x-jet-input id="email" type="number" class="mt-1 block w-full" wire:model.defer="email" />
        <x-jet-input-error for="email" class="mt-2" />
      @endif
      </div>
      <div class="modal-footer">
        <button wire:click="saveSalon" class="btn btn-outline-primary">Zapisz</button>

      </div>
    </div>
  </div>
</div>
