<x-slot name="header">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-xl text-gray-800 leading-tight">
          {{ Auth::user()->currentTeam->name }} / 
          <span class="font-semibold">Komunikator</span>
        </h2>
      </div>
      <div class="col text-right">
        @livewire('nav-beam-info')
      </div>
    </div>
  </div>
</x-slot>

<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="row">
      <div class="col-3">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Rozmowy') }}</h3>

        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg mt-2 p-3" style="max-height:550px;">

          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-primary" wire:click.prevent="$emit('getSwitch', '0')">
              <div class="d-flex w-100">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-text mt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                  <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <h5 class="mb-1 ml-2 text-center">Nowa rozmowa</h5>
              </div>
            </a>                           
            @foreach($getConversation as $tab)
            @if(is_array($tab['conversation']['last_message']))
            <?php $date = date_create($tab['conversation']['last_message']['created_at']); ?>
            @else
            <?php $date = date_create($tab['conversation']['created_at']); ?>
            @endif
            <?php $data = json_decode($tab['data']); ?>
            <?php $read = Chat::conversation(Chat::conversations()->getById($tab['id']))->setParticipant(Auth::user())->unreadCount(); ?>

            <a href="#" class="list-group-item list-group-item-action @if($read > 0) active @endif" wire:click.prevent="$emit('getSwitch', '{{ $tab['id'] }}')">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                  @if(!empty($data->title))
                  {{ $data->title }}
                  @endif
                </h5>
                <small class="text-right">{{ date_format($date, 'Y-m-d H:i:s') }}</small>
              </div>
              <small>
                @foreach($tab['conversation']['participants'] as $us)
                {{ $us['messageable']['firstname'] }} {{ $us['messageable']['name'] }}, 
                @endforeach
              </small>
            </a>
            @endforeach
          </div>
        </div>

      </div>
      <div class="col-9">
        
        @if($idConversation > 0)
        <h3 class="text-lg font-medium text-gray-900">{{ $conversation->data['title'] }}</h3>
          
          <div class="bg-white shadow-xl sm:rounded-lg mt-2 p-3">
            <div class="overflow-auto p-2 mb-2" style="max-height:460px;" id="chat">
              @foreach($data_chat as $tab)
                @livewire('communicator.load-messages', ['tab' => $tab], key($tab['id']))
              @endforeach
            </div>

            <script>
                var objDiv = document.getElementById("chat");
                objDiv.scrollTop = objDiv.scrollHeight;
            </script>

            <form wire:submit.prevent="$emit('sendMessagesConv')">
              <div class="input-group">
                  <input id="text" type="text" class="form-control" wire:model.defer="text" aria-describedby="button-addon2" />
                  <button class="btn btn-outline-primary" id="button-addon2">Wyślij</button>
              </div>
            </form>          
        </div>
        @endif
        
        @if($idConversation == 0)
        <h3 class="text-lg font-medium text-gray-900">{{ __('Nowa rozmowa') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">

          @livewire('communicator.new-communicator')
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

