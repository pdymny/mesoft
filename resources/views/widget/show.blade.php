<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-xl text-gray-800 leading-tight">
                        {{ Auth::user()->currentTeam->name }} / 
                        <span class="font-semibold">{{ __('Widget') }}</span>
                    </h2>
                </div>
                <div class="col text-right">

                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            </div>
        </div>

    </x-slot>
</x-app-layout>
