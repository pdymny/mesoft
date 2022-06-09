<div wire:ignore.self class="modal fade" id="addLoyalty">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Nowa regułka lojalnościowa
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <x-jet-label for="visits" value="{{ __('Ilość wizyt') }}" />
        <x-jet-input id="visits" type="number" class="mt-1 block w-full" wire:model.defer="visits" />
        <x-jet-input-error for="visits" class="mt-2" />

        <x-jet-label for="what" value="{{ __('Rodzaj rabatu') }}" class="mt-3" />
        <select id="what" type="text" class="form-control rounded-md shadow-sm mt-1 block w-full" wire:model.defer="what">
          <option value="0"></option>
          <option value="1">Kwotowy</option>
          <option value="2">Procentowy</option>
        </select>
        <x-jet-input-error for="what" class="mt-2" />

        <x-jet-label for="rabat" value="{{ __('Ilość rabatu') }}" class="mt-3" />
        <x-jet-input id="rabat" type="number" class="mt-1 block w-full" wire:model.defer="rabat" />
        <x-jet-input-error for="rabat" class="mt-2" />
      </div>
      <div class="modal-footer">
        <button wire:click="createLoyalty" class="btn btn-outline-primary">Zapisz</button>
      </div>
    </div>
  </div>
</div>
