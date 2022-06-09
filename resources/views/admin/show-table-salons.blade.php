<div class="table-responsive">

  <input class="form-control search-input w-50 d-inline" wire:model.debounce.500ms="searchTerm" type="text" placeholder="Szukaj..."/>

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
          <button type="button" class="btn btn-outline-success btn-sm" wire:click="$emit('allSalon', {{ $item['id'] }})">
            <span class="d-inline">Zmień</span>
          </button>
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="{{ count($headers) }}"><h2>Brak salonów o podanych parametrach.</h2></td></tr>
      @endif

      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </tbody>
  </table>

</div>