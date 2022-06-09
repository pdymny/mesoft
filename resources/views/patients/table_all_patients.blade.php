<div class="table-responsive">

  <input class="form-control search-input w-50 d-inline" wire:model.debounce.500ms="searchTerm" type="text" placeholder="Szukaj..."/>
  <button class="btn btn-outline-primary float-right d-inline" wire:click="downloadList">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
      <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
    </svg>
    <span class="d-inline">Pobierz listę pacjentów</span>
  </button>

  <button type="button" class="btn btn-outline-primary float-right d-inline mr-2"  wire:click="$emit('addPatient')">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journal-plus d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
      <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
      <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
    </svg>
    <span class="d-inline">Nowy pacjent</span>
  </button>

  <table class="table table-hover mt-4">
    <thead>
      @foreach ($headers as $key => $value)
      <th width="10%" style="cursor: pointer" wire:click="sort('{{ $key }}')">
        @if($sortColumn == $key) 
        <span>{!! $sortDirection == 'asc' ? '&#8659;':'&#8657;' !!}</span>
        @endif
        {{ is_array($value) ? $value['label'] : $value }}
      </th>
      @endforeach
      <th></th>
    </thead>
    <tbody>
      @if(count($data))
      @foreach ($data as $item)
      <tr>
        @foreach ($headers as $key => $value)
        <td>
          {!! is_array($value) ? $value['func']($item->$key) : $item->$key !!}
        </td>
        @endforeach
        <td>
          <div class="btn-group float-right" role="group">
            <a type="button" class="btn btn-outline-primary btn-sm" href="{{ route('patient', $item['id']) }}">Karta pacjenta</a>
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Zarządzaj
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <button type="button" class="dropdown-item" wire:click="addVisit">Nowa wizyta</button>
              <button class="dropdown-item" wire:click="$emit('openEmail', {{ $item['id'] }})">Wyślij e-mail</button>
              <button class="dropdown-item" wire:click="$emit('openSms', {{ $item['id'] }})">Wyślij SMS</button>
              <button class="dropdown-item" wire:click="$emit('editPatient', {{ $item['id'] }})">Edytuj pacjenta</button>
              <a type="button" class="dropdown-item" wire:click="$emit('removePatient', {{ $item['id'] }})">Usuń pacjenta</a>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="{{ count($headers) }}"><h2>Brak pacjentów w bazie.</h2></td></tr>
      @endif

      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </tbody>
  </table>

</div>

@livewire('visits.new-sms')
@livewire('visits.new-email')
@livewire('patients.add-patient')