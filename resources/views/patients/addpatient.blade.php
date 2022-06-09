
<div wire:ignore.self class="modal fade" id="addPatient">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        @if($switch == 'edit')
          Edytuj pacjenta / {{ $firstname }} {{ $name }}
        @else
          Nowy pacjent
        @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
            <x-jet-label for="firstname" value="{{ __('Imię') }}" />
            <x-jet-input id="firstname" type="text" class="mt-1 block w-full" wire:model.defer="firstname" />
            <x-jet-input-error for="firstname" class="mt-2" />

            <x-jet-label for="name" value="{{ __('Nazwisko') }}" class="mt-2" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
            <x-jet-input-error for="name" class="mt-2" />

            <x-jet-label for="pesel" value="{{ __('PESEL') }}" class="mt-2" />
            <x-jet-input id="pesel" type="number" class="mt-1 block w-full" wire:model.defer="pesel" />
            <x-jet-input-error for="pesel" class="mt-2" />

            <x-jet-label for="email" value="{{ __('E-mail') }}" class="mt-2" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
            <x-jet-input-error for="email" class="mt-2" />

            <x-jet-label for="phone" value="{{ __('Telefon') }}" class="mt-2" />
            <x-jet-input id="phone" type="number" class="mt-1 block w-full" wire:model.defer="phone" />
            <x-jet-input-error for="phone" class="mt-2" />

            <x-jet-label for="birth" value="{{ __('Data urodzenia') }}" class="mt-2" />
            <x-jet-input id="birth" type="date" class="mt-1 block w-full" wire:model.defer="birth" />
            <x-jet-input-error for="birth" class="mt-2" />

            <x-jet-label for="gender" value="{{ __('Płeć') }}" class="mt-2" />
            <select id="gender" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model.defer="gender">
              <option value="Nie podano / Inna">Nie podano / Inna</option>
              <option value="Kobieta">Kobieta</option>
              <option value="Mężczyzna">Mężczyzna</option>
            </select>
            <x-jet-input-error for="gender" class="mt-2" />

          </div>
          <div class="col-6">

            <x-jet-label for="address_city" value="{{ __('Miasto') }}" />
            <x-jet-input id="address_city" type="text" class="mt-1 block w-full" wire:model.defer="address_city" />
            <x-jet-input-error for="address_city" class="mt-2" />

            <x-jet-label for="address_code" value="{{ __('Kod pocztowy') }}" class="mt-2" />
            <x-jet-input id="address_code" type="text" class="mt-1 block w-full" wire:model.defer="address_code" />
            <x-jet-input-error for="address_code" class="mt-2" />

            <x-jet-label for="address_street" value="{{ __('Ulica') }}" class="mt-2" />
            <x-jet-input id="address_street" type="text" class="mt-1 block w-full" wire:model.defer="address_street" />
            <x-jet-input-error for="address_street" class="mt-2" />

            <x-jet-label for="address_number" value="{{ __('Numer domu') }}" class="mt-2" />
            <x-jet-input id="address_number" type="text" class="mt-1 block w-full" wire:model.defer="address_number" />
            <x-jet-input-error for="address_number" class="mt-2" />

            <x-jet-label for="description" value="{{ __('Uwagi') }}" class="mt-2" />
            <textarea id="description" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:200px;" wire:model.defer="description" /></textarea>
            <x-jet-input-error for="description" class="mt-2" />
          </div>
        </div>
        </div>
        <div class="modal-footer">
        @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
        @else
          @if($switch == 'edit')
            <button wire:click="$emit('saveEditPatient', {{ $idEdit}} )" class="btn btn-outline-primary">Zapisz</button>
          @else
            <button wire:click="createPatient" class="btn btn-outline-primary">Zapisz</button>
          @endif
        @endif
        </div>
    </div>
  </div>
</div>