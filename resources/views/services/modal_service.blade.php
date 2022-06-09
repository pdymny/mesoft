
<div wire:ignore.self class="modal fade" id="modalService">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          @if($func == 'create')
            Nowa usługa
          @else
            Edytuj usługę / {{ $title }}
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <x-jet-label for="title" value="{{ __('Nazwa usługi') }}" />
        <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
        <x-jet-input-error for="title" class="mt-2" />

        <x-jet-label for="time" value="{{ __('Przybliżony czas usługi w minutach') }}" class="mt-3" />
        <x-jet-input id="time" type="number" class="mt-1 block w-full" wire:model.defer="time" />
        <x-jet-input-error for="time" class="mt-2" />

        <x-jet-label for="cost" value="{{ __('Koszt usługi') }}" class="mt-3" />
        <x-jet-input id="cost" type="number" class="mt-1 block w-full" wire:model.defer="cost" />
        <x-jet-input-error for="cost" class="mt-2" />
       
      </div>
      <div class="modal-footer">
        @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
        @else
          @if($func == 'create')
            <button wire:click="createService" class="btn btn-outline-primary">Zapisz</button>
          @else
            <button wire:click="$emit('createService', {{ $idEdit }})" class="btn btn-outline-primary">Zapisz</button>
          @endif
        @endif
      </div>
    </div>
  </div>
</div>