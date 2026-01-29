<div>
    @section('scripts')
    <script src="{{ asset('template/libs/fullcalendar/index.global.min.js') }}"></script>
    @endsection

    @section('header')
    <link href="{{  asset('css/fc.css') }}" rel="stylesheet" />
    @endsection

 

    <div wire:ignore id="{{ $id }}"  style="width: 100%"></div>

    @script
        <script>

            let calendarInstance_{{ $id }};

            document.addEventListener("livewire:navigated", function () {

                if (calendarInstance_{{ $id }}) {
                    calendarInstance_{{ $id }}.refetchEvents();
                    return;
                }


                var calendarEl = document.getElementById("{{ $id }}");
                var currentYear = new Date().getFullYear();
                var currentMonth = new Date().getMonth();

                var isMobile = window.innerWidth < 768; // você pode ajustar o breakpoint

                var calendarInstance_{{ $id }} = new FullCalendar.Calendar(calendarEl, {
                    initialView: isMobile ? "timeGridDay" : "timeGridWeek",
                    timeZone: "America/Sao_Paulo",
                    displayEventTime: false,
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay"
                    },
                    allDaySlot: false,
                    slotMinTime: "07:00:00",
                    slotMaxTime: "21:00:00",
                    slotDuration: "01:00:00",
                    slotLabelInterval: "01:00",
                    slotEventOverlap: false,
                    eventOverlap: true,
                    eventMaxStack: 10,
                    hiddenDays: [0],
                    eventOrder: "title",
                    nowIndicator: true,
                    expandRows: true,
                    editable: true,
                    droppable: true,
                    // eventBorderColor: '#f00',
                    slotLabelFormat: {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: false
                    },
                    events: {
                        @if($endpoint)
                        url: '{{ $endpoint }}',
                        @endif
                        extraParams: function(){
                            let params = {};
                            document.querySelectorAll('.filters').forEach(function(select) {
                                params[select.name] = select.value;
                            });
                            return params;
                        }
                    },
                    dateClick: function(info) {
                        Livewire.dispatch('calendar-slot-clicked', {
                            datetime: info.dateStr,
                            x:info.jsEvent.clientX,
                            y:info.jsEvent.clientY
                        });
                    },
                    eventClick: function(info) {

                        Livewire.dispatch('calendar-show-event', {
                            id: info.event.id,
                            start: info.event.startStr,
                            props: info.event.extendedProps
                            // type: info.event.extendedProps.type,
                            // event:info.event
                        });
                    },
                    eventContent: function(arg) {
                        return { html: arg.event.title };
                    },
                    
                  
                    eventDrop: function(info) {
                        Livewire.dispatch('calendar-event-dropped', {
                            id: info.event.id,
                            start: info.event.startStr,
                            props: info.event.extendedProps,
                        });
                    },
                    eventAllow: function(dropInfo, draggedEvent) { 
                        
                        @if($config['allow_move_event_same_day'])
                            
                            if(draggedEvent.extendedProps.move) {
                                return true
                            }

                            // pega o dia original e o dia alvo 
                            const originalDay = draggedEvent.start.getDay();
                            // 0=domingo, 1=segunda... 
                            const targetDay = dropInfo.start.getDay(); // só permite se for o mesmo dia 
                            return originalDay === targetDay; 
                         @else
                         return true
                         @endif
                    },
                    eventResize: function(info) {
                        Livewire.dispatch('calendar-event-resized', {
                            id: info.event.id,
                            start: info.event.startStr
                        });
                    }
                });

                calendarInstance_{{ $id }}.render();

                window.addEventListener('eventDeleted', function (event) {
                    // Get the deleted event's ID (which was passed as 'uuid' in the PHP code above)

                    var eventId = event.detail.uuid;

                    // Find the event in the calendar and remove it
                    var calendarEvent = calendar.getEventById(eventId);
                    alert(calendarEvent);
                    if (calendarEvent) {
                        calendarEvent.remove(); // This removes it from the calendar view
                    }
                });

                // quando qualquer select mudar, refaz a busca
                document.querySelectorAll('.filters').forEach(function(select) {
                    select.addEventListener('change', function() {
                        calendarInstance_{{ $id }}.refetchEvents();
                        setTimeout(() => calendarInstance_{{ $id }}.updateSize(), 50);
                    });
                });

                window.addEventListener('refresh-calendar', () => {
                    calendarInstance_{{ $id }}.refetchEvents();
                    calendarInstance_{{ $id }}.updateSize();
                });

                window.addEventListener('resize-calendar', () => {
                    setTimeout(() => calendarInstance_{{ $id }}.updateSize(), 50);
                });
            });
        </script>
    @endscript
</div>
