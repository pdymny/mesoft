<x-slot name="header">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-xl text-gray-800 leading-tight">
          {{ Auth::user()->currentTeam->name }} / 
          Ustawienia / 
          <span class="font-semibold">{{ __('Widget & Powiadomienia') }}</span>
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
      <div class="col-6">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Ustawienia widgetu') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
          @livewire('settings.save-settings-widget')
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
          @livewire('settings.save-logo')
        </div>

        <a href="{{ route('guest_widget', Auth::user()->current_team_id) }}" class="btn btn-primary mt-4 w-100">
          Przejdź do widgeta
        </a>
      </div>
      <div class="col-6">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Ustawienia powiadomień SMS / E-mail') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
          @livewire('settings.save-settings-notify')
        </div>
      </div>
    </div>
  </div>
</div>

