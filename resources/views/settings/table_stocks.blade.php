<div class="table-responsive">

    <select class="form-control w-50" wire:model="account" value="{{ Auth::user()->id }}">
        @foreach($usersInTeam as $tab)
        <option value="{{ $tab->id }}">{{ $tab->firstname }} {{ $tab->name }}</option>
        @endforeach
    </select>

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
