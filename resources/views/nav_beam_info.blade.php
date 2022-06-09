<div>
	<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#printPack">
		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
		</svg>
		<span class="d-inline ml-1" style="font-size:12px;">{{ $name_pack }}</span>
	</button>
	<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#printSms">
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
	<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#printEmail">
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

    <a type="button" class="btn btn-outline-primary btn-sm" href="{{ route('communicator') }}">
<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat m-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
</svg>
      @if(Chat::messages()->setParticipant(Auth::user())->unreadCount() > 0)
      <span class="d-inline ml-1" style="font-size:12px;">
        {{ Chat::messages()->setParticipant(Auth::user())->unreadCount() }}
      </span>
      @endif
  </a>

	<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#printHelp">
		<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
		  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
		</svg>
	</button>
</div>

<!-- info packiet -->
@livewire('modal.show-pack', ['name_pack' => $name_pack])

<!-- kalkulator sms -->
@livewire('modal.show-sms-calc')

<!-- kalkulator e-mail -->
@livewire('modal.show-email-calc')

<!-- help -->
<div id="printHelp" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pomoc dla {{ $help_title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>{!! $help_text !!}</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('kontakt') }}" class="btn btn-outline-primary">Kontakt</a>
        <a href="{{ route('pomoc') }}" class="btn btn-outline-primary">Zobacz więcej</a>
      </div>
    </div>
  </div>
</div>

<!-- płatności -->
@livewire('modal.modal-pay')