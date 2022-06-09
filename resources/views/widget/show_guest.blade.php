
<x-jet-authentication-card>
	<x-slot name="logo">
		@if(!empty($logo))
		<a href="{{ $team->url_widget }}">
			<img src="{{ $logo }}" style="max-width:100px;">
		</a>
		@endif

		@if(!empty($team->name_widget))
		<a href="{{ $team->url_widget }}" style="text-decoration:none;">
			<h2 class="mt-3 font-weight-light text-black-500 text-uppercase" style="font-size:30px;">
				{{ $team->name_widget }}
			</h2>
		</a>
		@endif
	</x-slot>

@if($team->switch_widget == 1)
		@if($visit > 0)
			<div class="mb-4">
			Zaloguj się do panelu klienta, aby anulować wizytę.
			</div>
		@endif

		@csrf

		@if (session('status'))
            <div class="mb-4 font-medium text-green-500">
                {{ session('status') }}
            </div>
        @endif

		<div>
			<x-jet-label for="email" value="{{ __('Podaj e-mail lub numer telefonu') }}" />
			<x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus wire:model="email" />
		</div>

		<div class="mt-4">
			<x-jet-label for="pesel" value="{{ __('Podaj PESEL') }}" />
			<x-jet-input id="pesel" class="block mt-1 w-full" type="text" name="pesel" required wire:model="pesel" />
		</div>

		<div class="flex items-center justify-end mt-4">

			<button type="button" class="btn ml-4 btn-outline-primary" wire:click="loginClient">
				{{ __('Zaloguj do konta klienta') }}
			</button>
		</div>

		<div class="mt-5">
			<a class="btn btn-primary w-100" href="{{ $team->url_widget }}">Powrót do strony przychodni</a>
		</div>

<div wire:ignore.self class="modal fade" id="newVisitClient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Umów się na nową wizytę
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" wire:click="generateInvoicePack" class="btn btn-outline-primary">Zapisz</button>
      </div>
    </div>
  </div>
</div>

@if($team->delete_widget_visit == 1)
<div wire:ignore.self class="modal fade" id="deleteVisit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Anuluj wizytę
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	@if(!empty($data_visit))
      		Czy na pewno anulować wizytę <b>{{ $data_visit['date_visit'] }}</b>?
      	@endif
      </div>
      <div class="modal-footer">
      	<button type="button" wire:click="$emit('statusVisit', 0)" class="btn btn-outline-primary">Nie</button>
        <button type="button" wire:click="$emit('statusVisit', 1)" class="btn btn-outline-danger">Tak</button>
      </div>
    </div>
  </div>
</div>
@endif

@livewire('visits.new-visit', ['what' => 'guest'])
@else
	Widget jest wyłaczony.
@endif
</x-jet-authentication-card>