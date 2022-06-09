<div class="table-responsive">

  <input class="form-control search-input w-50 d-inline" wire:model.debounce.500ms="searchTerm" type="text" placeholder="Szukaj..."/>

@if(!empty($patient))
  <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#modalDoc">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journal-plus d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
      <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
      <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
    </svg>
    <span class="d-inline">Nowy dokument</span>
  </button>
@endif

  <table class="table table-hover mt-4">
    <thead>
      @foreach ($headers as $key => $value)
      <th width="15%" style="cursor: pointer" wire:click="sort('{{ $key }}')">
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
          <button class="btn btn-outline-primary btn-sm" wire:click="$emit('donwloadDoc', {{ $item['did'] }})">
            <span class="d-inline">Pobierz</span>
          </button>
          <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$emit('removeDoc', {{ $item['did'] }})">
            <span class="d-inline">Usuń</span>
          </button>
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="{{ count($headers) }}"><h2>Brak dokumentów w bazie.</h2></td></tr>
      @endif

      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </tbody>
  </table>
</div>

