
<div wire:ignore.self class="modal fade" id="addWorkScheldule">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          @if($func == 'create')
            Nowy szablon
          @else
            Edytuj szablon / {{ $name }}
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <x-jet-label for="name" value="{{ __('Nazwa szablonu') }}" />
        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
        <x-jet-input-error for="name" class="mt-2" />

        <table class="table">
          <tr>
            <th>
              <x-jet-label for="monday" value="{{ __('Poniedziałek') }}" class="mt-2" />
              <x-jet-input-error for="monday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="monday" wire:model.defer="monday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="monday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="monday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="monday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="monday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="tuesday" value="{{ __('Wtorek') }}" class="mt-2" />
              <x-jet-input-error for="tuesday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="tuesday" wire:model.defer="tuesday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="tuesday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="tuesday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="tuesday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="tuesday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="wednesday" value="{{ __('Środa') }}" class="mt-2" />
              <x-jet-input-error for="wednesday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="wednesday" wire:model.defer="wednesday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="wednesday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="wednesday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="wednesday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="wednesday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="thursday" value="{{ __('Czwartek') }}" class="mt-2" />
              <x-jet-input-error for="thursday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="thursday" wire:model.defer="thursday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="thursday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="thursday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="thursday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="thursday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="friday" value="{{ __('Piątek') }}" class="mt-2" />
              <x-jet-input-error for="friday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="friday" wire:model.defer="friday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="friday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="friday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="friday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="friday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="saturday" value="{{ __('Sobota') }}" class="mt-2" />
              <x-jet-input-error for="saturday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="saturday" wire:model.defer="saturday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="saturday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="saturday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="saturday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="saturday.end" />
            </td>
          </tr>
          <tr>
            <th>
              <x-jet-label for="sunday" value="{{ __('Niedziela') }}" class="mt-2" />
              <x-jet-input-error for="sunday" class="mt-2" />
            </th>
            <td>
              <input type="checkbox" class="form-check-input mt-3" id="sunday" wire:model.defer="sunday.check">
            </td>
            <td>
              <span class="d-inline mr-2">Od</span>
              <x-jet-input id="sunday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="sunday.start" />
            </td>
            <td>
              <span class="d-inline mr-2">do</span>
              <x-jet-input id="sunday" type="time" class="mt-1 block w-50 d-inline" wire:model.defer="sunday.end" />
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
      @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
      @else
          @if($func == 'create')
            <button wire:click="createWorkSchedule" class="btn btn-outline-primary">Zapisz</button>
          @else
            <button wire:click="$emit('createWorkSchedule', {{ $idEdit }})" class="btn btn-outline-primary">Zapisz</button>
          @endif
      @endif
      </div>
    </div>
  </div>
</div>