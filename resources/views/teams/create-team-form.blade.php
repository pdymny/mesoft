<x-jet-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Utwórz nową przychodnię') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Skorzystaj z darmowego pakietu dla nowej przychodni, a jeśli to za mało przejdź do Płatności w zakładce ustawienia, aby wykupić pakiet o rozszerzonych korzyściach.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-jet-label value="{{ __('Założyciel przychodni') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $this->user->firstname }} {{ $this->user->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nazwa przychodni') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autofocus />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Załóż przychodnię') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>