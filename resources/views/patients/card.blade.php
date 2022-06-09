<x-slot name="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-xl text-gray-800 leading-tight">
                    {{ Auth::user()->currentTeam->name }} / {{ __('Pacjent') }} / 
                    <span class="font-semibold">{{ $patient->firstname }} {{ $patient->name }}</span>
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

        <a href="{{ route('patients') }}" type="button" class="btn btn-outline-dark mb-3">
            <span class="d-inline">Wróć do listy</span>
        </a>

        <div class="btn-group mb-3">
          <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#coll_one" aria-expanded="false" aria-controls="coll_one">
            Dane pacjenta
        </button>
        <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#coll_two" aria-expanded="false" aria-controls="coll_two">
            Dokumentacja
        </button>
        <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#coll_three" aria-expanded="false" aria-controls="coll_three">
            Wizyty
        </button>
    </div>

    <div class="btn-group float-right" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-primary btn-sm" wire:click="$emit('openNewVisitPatient', {{ $patient->id }})">
            <span class="d-inline">Nowa wizyta</span>
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" wire:click="$emit('openSms', {{ $patient->id }})">
            <span class="d-inline">Wyślij SMS</span>
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" wire:click="$emit('openEmail', {{ $patient->id }})">
            <span class="d-inline">Wyślij e-mail</span>
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" wire:click="$emit('editPatient', {{ $patient->id }})">
            <span class="d-inline">Edytuj pacjenta</span>
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deletePatient">
            <span class="d-inline">Usuń pacjenta</span>
        </button>
    </div>

    <div class="collapse multi-collapse mt-3 show" id="coll_one">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Dane pacjenta') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th>Imię i Nazwisko</th>
                            <td>{{ $patient->firstname }} {{ $patient->name }}</td>
                        </tr>
                        <tr>
                            <th>PESEL</th>
                            <td>{{ $patient->pesel }}</td>
                        </tr>
                        <tr>
                            <th>Data urodzenia</th>
                            <td>{{ $patient->birth }}</td>
                        </tr>
                        <tr>
                            <th>Płeć</th>
                            <td>{{ $patient->gender }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th>Telefon</th>
                            <td>{{ $patient->phone }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $patient->email }}</td>
                        </tr>
                        <tr>
                            <th>Adres</th>
                            <td>{{ $patient['address_number'] }} {{ $patient['address_street'] }} {{ $patient['address_code'] }} {{ $patient['address_city'] }}</td>
                        </tr>
                        <tr>
                            <th>Komentarz</th>
                            <td>{{ $patient->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
    </div>

    <div class="collapse multi-collapse mt-4" id="coll_two">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Dokumentacja') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            @livewire('documents.table-documents', ['patient' => $patient])
        </div>
    </div>

    <div class="collapse multi-collapse mt-4" id="coll_three">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Wizyty') }}</h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-2 p-3">
            @livewire('visits.table-visits', ['patient' => $patient->id])
        </div>
    </div>

</div>
</div>

@livewire('patients.add-patient')
@livewire('patients.delete-patient', ['patient' => $patient])
@livewire('documents.modal-documents', ['patient_id' => $patient->id])

@livewire('visits.new-visit')
@livewire('visits.new-sms')
@livewire('visits.new-email')