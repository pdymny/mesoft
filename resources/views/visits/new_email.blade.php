<div wire:ignore.self class="modal fade" id="sendEmail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          @if(!empty($patient))
          Nowy e-mail do: {{ $patient->firstname }} {{ $patient->name }}
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <x-jet-label for="text" value="{{ __('Treść wiadomości') }}"/>
        <textarea id="text" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:150px;" wire:model="text" /></textarea>
        <x-jet-input-error for="text" class="mt-2" />
      </div>
      <div class="modal-footer">
        @if($user->currentTeam->pack_email > 0)
        <button type="button" wire:click="saveSentEmail" class="btn btn-outline-primary">Wyślij</button>
        @else
        <button type="button" class="btn btn-danger" disabled>Brak punktów e-mail.</button>
        @endif
      </div>
    </div>
  </div>
</div>