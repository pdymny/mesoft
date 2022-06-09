<div>
    @if($dashboard == 'false')
    <select class="form-control w-50" wire:model="account">
        @foreach($usersInTeam as $tab)
        <option value="{{ $tab->id }}">{{ $tab->firstname }} {{ $tab->name }}</option>
        @endforeach
    </select>
    @endif

    <div id='calendar' class="m-3"></div>

    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
            events: [
            @foreach($data as $tab)
            {
              title: "{{ $tab['firstname'] }} {{ $tab['name'] }} ({{ $tab['title'] }})", 
              start: "{{ $tab['date_visit'] }}", 
              end: "{{ Carbon::create($tab['date_visit'])->addMinute($tab['time']) }}"
            },
            @endforeach
          ],
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          }
        });
        calendar.setOption('locale', 'pl');
        calendar.render();
      });

    </script>
</div>