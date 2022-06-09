
<div wire:ignore.self class="modal fade" id="modalData">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Dane do faktury
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">

            <x-jet-label for="name" value="{{ __('Nazwa firmy') }}" />
            <input id="name" type="text" class="form-control mt-1 block w-full" wire:model.defer="name"/>
            <x-jet-input-error for="name" class="mt-2" />

            <x-jet-label for="nip" value="{{ __('NIP') }}" class="mt-3" />
            <input id="nip" type="text" class="form-control mt-1 block w-full" wire:model.defer="nip"/>
            <x-jet-input-error for="nip" class="mt-2" />

            <x-jet-label for="regon" value="{{ __('Regon') }}" class="mt-3" />
            <input id="regon" type="text" class="form-control mt-1 block w-full" wire:model.defer="regon"/>
            <x-jet-input-error for="regon" class="mt-2" />

          </div>
          <div class="col-6">

            <x-jet-label for="city" value="{{ __('Miasto') }}" />
            <input id="city" type="text" class="form-control mt-1 block w-full" wire:model.defer="city"/>
            <x-jet-input-error for="city" class="mt-2" />

            <x-jet-label for="code" value="{{ __('Kod pocztowy') }}" class="mt-3" />
            <input id="code" type="text" class="form-control mt-1 block w-full" wire:model.defer="code"/>
            <x-jet-input-error for="code" class="mt-2" />

            <x-jet-label for="street" value="{{ __('Ulica') }}" class="mt-3" />
            <input id="street" type="text" class="form-control mt-1 block w-full" wire:model.defer="street"/>
            <x-jet-input-error for="street" class="mt-2" />

            <x-jet-label for="number" value="{{ __('Numer domu') }}" class="mt-3" />
            <input id="number" type="text" class="form-control mt-1 block w-full" wire:model.defer="number"/>
            <x-jet-input-error for="number" class="mt-2" />

          </div>
        </div>
        <div class="modal-footer mt-3">
          <button type="button" wire:click="saveData" class="btn btn-outline-primary">Zapisz</button>
        </div>
      </div>
    </div>
  </div>