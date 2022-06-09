
<div wire:ignore.self class="modal fade" id="actionUser">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Konto: {{ $firstname }} {{ $name }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <div class="table-responsive">

        <table class="table table-hover mt-4">
            <thead>
                @foreach ($headers as $key => $value)
                <th>
                    {{ is_array($value) ? $value['label'] : $value }}
                </th>
                @endforeach
            </thead>
            <tbody>
                @if(!empty($data))
                @foreach($data->notifications as $notification)
                @if($notification->data['team_id'] == Auth::user()->current_team_id)
                <tr>
                    <td>{{ $notification->created_at }}</td>
                    <td>{!! $notification->data['text'] !!}</td>
                </tr>
                @endif
                @endforeach
                @else
                <tr><td colspan="{{ count($headers) }}"><h2>Brak akcji w bazie.</h2></td></tr>
                @endif
            </tbody>
        </table>

        </div>   
      </div>
      <div class="modal-footer">


      </div>
    </div>
  </div>
</div>
