<x-slot name="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-xl text-gray-800 leading-tight">
                    {{ Auth::user()->currentTeam->name }} / 
                    <span class="font-semibold">{{ __('Ustawienia') }}</span>
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
            <div class="col-3 mt-3">
                <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('settings')">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3 text-center">
                        <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-house-door mx-auto mt-3 d-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                          <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                      </svg>
                      <div class="text-xl mt-3 text-gray-500">
                        Ustawienia przychodni
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3 mt-3">
            <a href="{{ route('work_schedule') }}" :active="request()->routeIs('settings')">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3 text-center">
                    <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-table mx-auto d-block mt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                  </svg>
                  <div class="text-xl mt-3 text-gray-500">
                    Grafik pracy
                </div>
            </div>
        </a>
    </div>
    <div class="col-3 mt-3">
        <a href="{{ route('stocks') }}" :active="request()->routeIs('settings')">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3 text-center">
                <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-archive mx-auto mt-3 d-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
              </svg>
              <div class="text-xl mt-3 text-gray-500">
                Historia akcji
            </div>
        </div>
    </a>
</div>
<div class="col-3 mt-3">
    <a href="{{ route('payments') }}" :active="request()->routeIs('settings')">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3 text-center">
            <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-credit-card mt-3 mx-auto d-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
              <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
          </svg>
          <div class="text-xl mt-3 text-gray-500">
            Płatności
        </div>
    </div>
</a>
</div>
<div class="col-3 mt-3">
    <a href="{{ route('widget') }}" :active="request()->routeIs('settings')">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3 text-center">
            <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-card-text mt-3 mx-auto d-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
              <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
          </svg>
          <div class="text-xl mt-3 text-gray-500">
            Widget & Powiadomienia
        </div>
    </div>
</a>
</div>
</div>
</div>
</div>
