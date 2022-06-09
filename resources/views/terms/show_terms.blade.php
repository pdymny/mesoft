<x-slot name="header">
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="text-xl text-gray-800 leading-tight">
					{{ Auth::user()->currentTeam->name }} / 
					<span class="font-semibold">{{ __('Terminarze') }}</span>
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
		<h3 class="text-lg font-medium text-gray-900">{{ __('Kalendarz') }}</h3>
		
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
			@livewire('terms.table-terms', ['dashboard' => 'false'])
		</div>
	</div>
</div>
