<x-slot name="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-xl text-gray-800 leading-tight">
                    {{ Auth::user()->currentTeam->name }} /  
                    <span class="font-semibold">Polecaj aplikację</span>
                </h2>
            </div>
            <div class="col text-right">
                @livewire('nav-beam-info')
            </div>
        </div>
    </div>
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    @if(empty(Auth::user()->recomend_code))
    <x-jet-form-section submit="saveCode">
        <x-slot name="title">
            {{ __('Polecaj aplikację') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Za polecenie aplikacji udzielamy 10% prowizji dla polecającego i 5% prowizji dla osoby, która wykupi dostęp do aplikacji. Wpisz obok kod, zapisz i zacznij polecać aplikację. Kod należy wpisać przy opłacaniu faktury.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="current_password" value="{{ __('Wpisz kod, którego chcesz używać') }}" />
                <x-jet-input id="current_password" type="text" class="mt-1 block w-full" wire:model.defer="code" min="5"/>
                <x-jet-input-error for="current_password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Zapisano.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Zapisz') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    @else
    <x-jet-form-section submit="saveCode">
        <x-slot name="title">
            {{ __('Polecaj aplikację') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Za polecenie aplikacji udzielamy 10% prowizji dla polecającego i 5% prowizji dla osoby, która wykupi dostęp do aplikacji. Poniżej znajdziesz listę poleconych osób za które uzyskasz wypłatę. Kod należy wpisać przy opłacaniu faktury') }}
        </x-slot>

        <x-slot name="form">

            <table style="width:300px;">
                <tr>
                    <th>Kod polecający</th>
                    <td>{{ Auth::user()->recomend_code }}</td>
                </tr>
                <tr>
                    <th>Do wypłaty</th>
                    <td>
                    @if(!empty($recomend_acount))
                        {{ $recomend_acount->account }} PLN
                    @else
                        0 PLN
                    @endif
                </td>
            </tr>
        </table>

        </x-slot>
    </x-jet-form-section>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 p-3">
      @livewire('table-recommend')
    </div>

    @endif
</div>
