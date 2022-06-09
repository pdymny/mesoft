<div class="table-responsive">

  <input class="form-control search-input w-50 d-inline" wire:model.debounce.500ms="searchTerm" type="text" placeholder="Szukaj..."/>
@if($patient == 0)
@if($dashboard != 'true')
    <button type="button" class="btn btn-outline-primary d-inline float-right ml-2" wire:click="downloadList">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
      <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
  </svg>
  <span class="d-inline">Pobierz listę wizyt</span>
</button>
@endif
  <button type="button" class="btn btn-outline-primary float-right" wire:click="$emit('openNewVisit')">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journal-plus d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
      <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
      <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
    </svg>
    <span class="d-inline">Nowa wizyta</span>
  </button>
@endif
  <br/>
@if($dashboard != 'true')
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-outline-primary" wire:click="$emit('switchData', '-1')">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
      </svg>
    </button>
    <button type="button" id="buttonDate" class="btn btn-outline-primary" wire:click="$emit('switchData', '0')">Wszystkie dni</button>
    <button type="button" class="btn btn-outline-primary" wire:click="$emit('switchData', '1')">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
      </svg>
    </button>
  </div>

  <select class="form-control w-40 d-inline mt-2" wire:model.debounce.500ms="searchWorker">
    <option value="0">Wszystkie</option>
    @foreach($workers as $worker)
    <option value="{{ $worker['id'] }}">{{ $worker['firstname'] }} {{ $worker['name'] }}</option>
    @endforeach
  </select>

  <select class="form-control w-40 d-inline mt-2" wire:model.debounce.500ms="searchStatus">
    <option value="0">Wszystkie</option>
    <option value="1">Anulowane</option>
    <option value="2">Oczekujące</option>
    <option value="3">Anulowane przez klienta</option>
    <option value="4">Anulowane przez pracownika</option>
    <option value="5">Zrealizowane</option>
  </select>
@endif
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
            @if($dashboard == 'true')
              <a type="button" class="btn btn-outline-primary btn-sm" href="{{ route('patient', $item['idp']) }}">Karta pacjenta</a>
              <a type="button" class="btn btn-outline-primary btn-sm" wire:click="$emit('cardVisit', {{ $item['idv'] }})">Karta wizyty</a>
            @else
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Zarządzaj
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            @if($patient == 0)
              <button class="dropdown-item" wire:click="$emit('openEmail', {{ $item['idp'] }})">Wyślij e-mail</button>
              <button class="dropdown-item" wire:click="$emit('openSms', {{ $item['idp'] }})">Wyślij SMS</button>
            @endif
              <button class="dropdown-item" wire:click="$emit('editVisit', {{ $item['idv'] }})">Edytuj wizytę</button>
              <a type="button" class="dropdown-item" wire:click="$emit('cancelVisit', {{ $item['idv'] }})">Anuluj wizytę</a>
            </div>
            @endif
          </div>
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="{{ count($headers) }}"><h2>Brak wizyt w bazie.</h2></td></tr>
      @endif

      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </tbody>
  </table>

</div>

