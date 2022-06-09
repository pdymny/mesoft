
<x-slot name="header">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-xl text-gray-800 leading-tight">
          {{ Auth::user()->currentTeam->name }} / 
          <span class="font-semibold">{{ __('Pulpit') }}</span>
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

    @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
    <div class="alert alert-danger mb-5" role="alert">
      Termin ważności pakietu minął. Zapraszamy do przedłużenia pakietu w zakładce Ustawienia -> Płatności.
    </div>
    @endif

    <h3 class="text-lg font-medium text-gray-900 d-inline">{{ __('Twoje dzisiejsze wizyty') }}</h3>
    
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 p-3">
      @livewire('visits.table-visits', ['dashboard' => 'true'])
    </div>

    <x-jet-section-border />

    <h3 class="text-lg font-medium text-gray-900 d-inline">{{ __('Kartki z informacjami') }}</h3>

    <button type="button" class="btn btn-outline-primary d-inline float-right" data-toggle="modal" data-target="#addCart">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-plus d-inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
        <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
      </svg>
      <span class="d-inline">Nowa kartka</span>
    </button>

    @livewire('dashboard.card-dashboard')

  </div>
</div>

@livewire('dashboard.add-card')
@livewire('visits.new-visit')
@livewire('visits.card-visit')
