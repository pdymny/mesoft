<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Auth::user()->currentTeam->name }} | {{ config('app.name', 'Mesoft') }} - Oprogramowanie dla Twojej przychodni.</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='{{ asset("js/fullcalendar/main.css") }}' rel='stylesheet' />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    
    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>


</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100"> 
        @livewire('navigation-dropdown')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}

            @if(Auth::user()->currentTeam->id_pack == 0)
            <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

            </div>
            @endif

        </main>

        <footer class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 text-gray-600 sticky-top" style="font-size:14px;">
            <div class="float-left w-50 d-inline">
                Oprogramowanie {{ config('app.name', 'Mesoft') }}.
            </div>
            <div class="float-right w-90 d-inline">
                <a href="{{ route('regulamin') }}">Regulamin</a> | 
                <a href="{{ route('pomoc') }}">Pomoc</a> | 
                <a href="{{ route('kontakt') }}">Kontakt</a>
            </div>
        </footer>
    </div>

    @stack('modals')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pl.min.js" integrity="sha512-ScqJL8X5IqP89pKmQnXULodix6OkrTtcWiTdJxPGPGdrncyJkI7KOwNRPqzZ6lWnTk/u5xboSjEeYQgeyOHyhQ==" crossorigin="anonymous"></script>
        <script src='{{ asset("js/fullcalendar/main.js") }}'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

        window.addEventListener('close-modal', event => {
            $('#' + event.detail.modal).modal('hide');
        });

        window.addEventListener('open-modal', event => {
            $('#' + event.detail.modal).modal('show');
        });

        window.addEventListener('xd', event => {
            $('#' + event.detail.modal).modal('show');
        });

        window.addEventListener('switch-date', event => {
            $('#buttonDate').text(event.detail.date);
        });

        window.addEventListener('livewire-upload-finish', event => {
            $('#adddoc').attr("disabled", false);
        });

        window.addEventListener('livewire-time-unlock', event => {
            $('#time').attr("disabled", false);
        });

        $('#datepicker').datepicker({
            language: "pl",
            startDate: "{{ Carbon::now() }}"
        });

        $('#datepicker').on('changeDate', function() {
            $('#date').val(
                date = $('#datepicker').datepicker('getFormattedDate'),
                Livewire.emit('updateTerm', date),
                );
        });

        window.addEventListener('chat_down', event => {
            var objDiv = document.getElementById("chat");
            objDiv.scrollTop = objDiv.scrollHeight;
        });

        window.addEventListener('DOMContentLoaded', event => {
            var obj = JSON.parse(event.detail.data);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              events: obj,
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
            calendar.setOption('locale', 'pl');
            calendar.render();
        });

        window.addEventListener('alert', event => { 
            toastr[event.detail.type](event.detail.message, 
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

    </script>

    @livewireScripts

</body>
</html>
