<form wire:submit.prevent="sendMessages">

	<label for="team" class="mt-3">{{ __('Wybierz przychodnię') }}</label>
	<select class="form-control mt-1 block w-full" wire:model="team" wire:click="$emitTo('communicator.new-communicator', 'searchUser')">
		@foreach (Auth::user()->allTeams() as $tab_team)
		<option value="{{ $tab_team->id }}">{{ $tab_team->name }}</option>
		@endforeach
	</select>

	<label for="participants" class="mt-3">{{ __('Do kogo wysłać wiadomość?') }}</label>
	<select multiple class="form-control mt-1 block w-full" id="participants" wire:model="participants">
		@foreach($contact as $tab) 
		@if($tab['id'] != Auth::user()->id)
		<option value="{{ $tab['id'] }}">{{ $tab['firstname'] }} {{ $tab['name'] }}</option>
		@endif
		@endforeach
	</select>
	<x-jet-input-error for="participants" class="mt-2" />

	<label for="text" class="mt-3">{{ __('Tytuł rozmowy') }}</label>
	<input id="title" type="text" class="form-control mt-1 block w-full" wire:model.defer="title" />
	<x-jet-input-error for="title" class="mt-2" />

	<label for="text" class="mt-3">{{ __('Treść wiadomości') }}</label>
	<textarea id="text" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:150px;" wire:model.defer="text" /></textarea>
	<x-jet-input-error for="text" class="mt-2" />

	<button class="btn btn-outline-primary mt-3 float-right">Wyślij</button>
</form>
