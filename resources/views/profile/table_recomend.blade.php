<div class="table-responsive">

<table class="table table-hover mt-4">
    <thead>
        @foreach ($headers as $key => $value)
        <th width="20%" style="cursor: pointer" wire:click="sort('{{ $key }}')">
            @if($sortColumn == $key) 
            <span>{!! $sortDirection == 'asc' ? '&#8659;':'&#8657;' !!}</span>
            @endif
            {{ is_array($value) ? $value['label'] : $value }}
        </th>
        @endforeach
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
          </tr>
          @endforeach

        @else
        <tr><td colspan="{{ count($headers) }}"><h2>Brak poleconych w bazie.</h2></td></tr>
        @endif

        <div class="mt-4">
          {{ $data->links() }}
      </div>
  </tbody>
</table>

</div>
