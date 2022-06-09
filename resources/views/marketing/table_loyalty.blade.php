<div class="table-responsive">

  <button class="btn btn-outline-primary float-right d-inline mr-2" wire:click="$emit('addLoyalty')">
    <span class="d-inline">Nowa regułka</span>
</button>

<table class="table table-hover mt-5">
    <thead>
        @foreach ($headers as $key => $value)
        <th>
            {{ is_array($value) ? $value['label'] : $value }}
        </th>
        @endforeach
    </thead>
    <tbody>
        @if(!empty($data))
        @foreach ($data as $item)
        <tr>
            @foreach ($headers as $key => $value)
            <td>
              {!! is_array($value) ? $value['func']($item->$key) : $item->$key !!}
          </td>
          @endforeach
          <td>
            <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$emit('removeLoyalty', {{ $item['id'] }})">
                <span class="d-inline">Usuń</span>
            </button>
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="{{ count($headers) }}">Brak ustawień programu lojalnościowego.</td></tr>
    @endif
</tbody>
</table>

</div>
