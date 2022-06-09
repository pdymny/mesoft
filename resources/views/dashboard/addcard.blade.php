
<div wire:ignore.self class="modal fade" id="addCart">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nowa kartka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">

          <x-jet-label for="title" value="{{ __('Tytuł kartki') }}" />
          <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
          <x-jet-input-error for="title" class="mt-2" />

          <x-jet-label for="text" value="{{ __('Wiadomość') }}" class="mt-3" />
          <textarea id="text" type="text" class="form-control rounded-md shadow-sm mt-1 block w-full" style="height:150px;" wire:model.defer="text" /></textarea>
          <x-jet-input-error for="text" class="mt-2" />

        </div>
        <div class="modal-footer">
          @if (session()->has('message'))
            {{ session('message') }}
          @endif
          @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
          <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
          @else
          <button wire:click="createCart" class="btn btn-outline-primary">Zapisz</button>
          @endif
        </div>
    </div>
  </div>
</div>