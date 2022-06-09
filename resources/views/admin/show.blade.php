<x-slot name="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-xl text-gray-800 leading-tight">
                    <span class="font-semibold">{{ __('Panel administratora') }}</span>
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
        @if(Auth::user()->admin == 1)
        <h3 class="text-lg font-medium text-gray-900">{{ __('Lista kont') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            @livewire('admin.show-table-user')
        </div>

        <h3 class="text-lg font-medium text-gray-900 mt-4">{{ __('Lista salonów') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            @livewire('admin.show-table-salons')
        </div>

        <h3 class="text-lg font-medium text-gray-900 mt-4">{{ __('Lista płatności') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            @livewire('settings.show-table-invoices', ['admin' => 1])
        </div>


        @endif
    </div>
</div>

@livewire('admin.modal-action')
@livewire('admin.all-salon')
@livewire('admin.edit-invoice')