<div class="table-responsive">

  <input class="form-control search-input w-50 d-inline" wire:model.debounce.500ms="searchTerm" type="text" placeholder="Szukaj..."/>

  <button type="button" class="btn btn-outline-primary float-right d-inline mr-2" data-toggle="modal" data-target="#printSms">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-phone d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
      <path fill-rule="evenodd" d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
    </svg>
    <span class="d-inline ml-1" style="font-size:12px;">
      @if($user->currentTeam->pack_sms > 0)
      {{ $user->currentTeam->pack_sms }} szt.
      @else
      0 szt.
      @endif
    </span>
  </button>

  <button type="button" class="btn btn-outline-primary float-right d-inline mr-2" data-toggle="modal" data-target="#printEmail">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
    </svg>
    <span class="d-inline ml-1" style="font-size:12px;">
      @if($user->currentTeam->pack_email > 0)
      {{ $user->currentTeam->pack_email }} szt.
      @else
      0 szt.
      @endif
    </span>
  </button>

  <button class="btn btn-outline-primary float-right d-inline mr-2" wire:click="$emit('switchModalData')">
    <span class="d-inline">Dane do faktury</span>
  </button>

  <button class="btn btn-outline-primary float-right d-inline mr-2" wire:click="$emit('switchModalInvoice')">
    <span class="d-inline">Wykup nowy pakiet</span>
  </button>

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
          @if($item['status'] == 1)
          <button type="button" class="btn btn-outline-success btn-sm" wire:click="$emit('modalPay', {{ $item['id'] }})">
            <span class="d-inline">Opłać</span>
          </button>
          @endif
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="{{ count($headers) }}"><h2>Brak faktur.</h2></td></tr>
      @endif

      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </tbody>
  </table>

</div>