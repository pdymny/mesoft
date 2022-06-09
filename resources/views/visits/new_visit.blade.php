<div wire:ignore.self class="modal fade" id="newVisit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        @if($switch == 'create')
          Nowa wizyta
        @else
          Edytuj wizytę \ {{ $date }}
        @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-6">
            @if($what != 'guest')
            <x-jet-label for="patient" value="{{ __('Pacjent') }}" />
              <select class="form-control" wire:model="patient">
                <option value="0"></option>
              @forelse($base_patient as $tab)
                <option value="{{ $tab['id'] }}">{{ $tab['firstname'] }} {{ $tab['name'] }}</option>
              @empty
                <option value="0">Brak pacjentów.</option>
              @endforelse
              </select>
              <x-jet-input-error for="patient" class="mt-2" /> 
            @endif

            <x-jet-label for="worker" value="{{ __('Specjalista') }}" class="mt-3" />
              <select class="form-control" wire:model="worker">
                <option value="0"></option>
              @forelse($base_worker as $tab)
                <option value="{{ $tab['id'] }}">{{ $tab['firstname'] }} {{ $tab['name'] }} ({{ $tab['position'] }})</option>
              @empty
                <option value="0">Brak specjalistów.</option>
              @endforelse
              </select>
              <x-jet-input-error for="worker" class="mt-2" /> 

            <x-jet-label for="service" value="{{ __('Usługa') }}" class="mt-3" />
              <select class="form-control" wire:model="service">
                <option value="0"></option>
              @forelse($base_service as $tab)
                <option value="{{ $tab['id'] }}">{{ $tab['title'] }} - ({{ $tab['cost'] }} PLN, {{ $tab['time'] }} minut)</option>
              @empty
                <option value="0">Brak usług.</option>
              @endforelse
              </select>
              <x-jet-input-error for="service" class="mt-2" /> 

          @if($what != 'guest')
          @if($switch == 'create')
            @if(Auth::user()->currentTeam->switch_sms == true)
              @if(Auth::user()->currentTeam->pack_sms > 0)
              <div class="custom-control custom-switch mt-4">
                <input type="checkbox" class="custom-control-input" id="switch_sms" wire:model="switch_sms">
                <label class="custom-control-label" for="switch_sms">Czy wysłać powiadomienie SMS?</label>
              </div>
              @else
                <div class="mt-4" style="font-size: 12px;">
                  Brak powiadomień sms. Doładuj konto.
                </div>
              @endif 
            @else
              <div class="mt-4" style="font-size: 12px;">
                Powiadomienia SMS zostały wyłączone w ustawieniach.
              </div>
            @endif

            @if(Auth::user()->currentTeam->switch_email == true)
              @if(Auth::user()->currentTeam->pack_email > 0)
              <div class="custom-control custom-switch mt-4">
                <input type="checkbox" class="custom-control-input" id="switch_email" wire:model="switch_email">
                <label class="custom-control-label" for="switch_email">Czy wysłać powiadomienie E-mail?</label>
              </div>
              @else
                <div class="mt-4" style="font-size: 12px;">
                  Brak powiadomień e-mail. Doładuj konto.
                </div>
              @endif 
            @else
              <div class="mt-4" style="font-size: 12px;">
                Powiadomienia E-mail zostały wyłączone w ustawieniach.
              </div>
            @endif
          @endif
          @endif

          </div>
          <div class="col-6">

            <x-jet-label for="date" value="{{ __('Data wizyty') }}"/>
            <input id="datepicker" type="text" class="form-control" wire:model="date">
            <x-jet-input-error for="date" class="mt-2" />

            <x-jet-label for="time" value="{{ __('Godzina wizyty') }}" class="mt-3" />
              <select class="form-control" wire:model="time">
              @forelse($select_time as $tab)
              <option value="{{ $tab }}">{{ $tab }}</option>
              @empty
                <option value="0">Brak wolnych godzin.</option>
              @endforelse
              </select>
            <x-jet-input-error for="time" class="mt-2" /> 

            @if(!empty($time))
            <x-jet-label for="xd" value="{{ __('Podsumowanie') }}" class="mt-3"/>
            <div>
              Wizyta zostanie zaplanowana na dnia <b>{{ $date }}</b> o godz.: <b>{{ $time }}</b>.
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">

      @if($what == 'guest')
        <button type="button" wire:click="saveVisit" class="btn btn-outline-primary">Zapisz</button>
      @else
      @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
      @else
        @if($switch == 'create')
          @if(Auth::user()->currentTeam->id_pack == 0 and $count_visit >= 30)
          <button class="btn btn-outline-danger" disabled>Został przekroczony limit 30 wizyt dla tej przychodni.</button>
          @else
          <button type="button" wire:click="saveVisit" class="btn btn-outline-primary">Zapisz</button>
          @endif
        @else
          <button type="button" wire:click="saveEditVisit" class="btn btn-outline-primary">Zapisz</button>
        @endif
      @endif
      @endif
      </div>
    </div>
  </div>
</div>
