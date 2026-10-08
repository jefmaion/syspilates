<div>

 <div class="mb-4 d-flex align-items-center justify-content-between">
            <div>
                 <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" wire:click="previous" class="btn "><</button>
                  <button type="button" wire:click="next" class="btn ">></button>
                </div>
                <button type="button" wire:click="today" class="btn ">Hoje</button>
            </div>
            <div>
                <h2>
                    @if($currentView === 'month')
                            {{ \Carbon\Carbon::parse($currentDate)->translatedFormat('F \d\e Y') }}
                        @elseif($currentView === 'week')
                            @php
                        // Captura o primeiro dia da semana (Segunda) e o último (Sábado, baseado no seu grid)
                        $startOfWeek = \Carbon\Carbon::parse($currentDate)->startOfWeek(\Carbon\Carbon::MONDAY);
                        $endOfWeek = $startOfWeek->copy()->addDays(5); // 5 dias após segunda = Sábado
                    @endphp
        
        <span>
            {{ $startOfWeek->translatedFormat('j \d\e M\.') }} – {{ $endOfWeek->translatedFormat('j \d\e M\. \d\e Y') }}
        </span>
            @else
                {{ \Carbon\Carbon::parse($currentDate)->translatedFormat('l, d \d\e F') }}
            @endif
                </h2>
            </div>
            <div>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" wire:click="changeView('month')" class="btn {{ $currentView == 'month' ? 'active' : '' }}">Mês</button>
                  <button type="button" wire:click="changeView('week')" class="btn {{ $currentView == 'week' ? 'active' : '' }}">Semana</button>
                  <button type="button" wire:click="changeView('day')" class="btn {{ $currentView == 'day' ? 'active' : '' }}">Dia</button>
                </div>
            </div>
        </div>

       

           <table class="table table-bordered" style="trfansition: opacity 0.15s ease;" wire:loading.class="opfacity-50">
            @if($currentView === 'week')
               <thead>
                   <tr>
                       <th width="1%"></th>
                       @foreach($days as $day)

                       <th class="text-center" width="15%">
                           {{ $day->translatedFormat('D') }} {{ $day->format('d/m') }}
                       </th>
                       @endforeach
                   </tr>
               </thead>
               <tbody>
                   @foreach($hours as $hour)
                    <tr wire:key="week-row-{{ $loop->index }}-{{ Str::slug($hour) }}">
                        
                        <th class="text-middle">{{ $hour }}</th>
                        @foreach($days as $day)

                            @php
                                // Cria a chave composta de Data + Hora do Slot (ex: "2026-10-02 08:00")
                                $slotKey = $day->format('Y-m-d') . ' ' . $hour;

                                // Busca os eventos específicos deste horário
                                $slotEvents = $events[$slotKey] ?? [];
                            @endphp

                        <td style="height: 150px !important;" wire:key="slot-{{ $slotKey }}"  x-data class="p-1 pb-4 {{ $day->isToday() ? 'bg-yellow-lt' : '' }}  " data-datetime="{{ $day->format('Y-m-d '. $hour) }}"
                            oncontextmenu="event.preventDefault(); 
                            if(event.target === this || event.target.classList.contains('overflow-auto') || event.target.tagName === 'DIV') { 
                                Livewire.dispatch('open-context-menu', { 
                                    date: '{{ $slotKey }}', 
                                    x: event.clientX, 
                                    y: event.clientY 
                                }); 
                            }"


                            ondragover="event.preventDefault()"                             
                            ondragenter="this.classList.add('bg-warning-lt')"  
                            ondragleave="this.classList.remove('bg-warning-lt')"
                            
              
                            ondrop="
                                let eventId = event.dataTransfer.getData('text/plain'); 
                                let targetDatetime = this.dataset.datetime;
                                let component = Livewire.find(this.closest('[wire\\:id]').getAttribute('wire:id'));

                                // alert(eventId)

                                component.moveEvent(eventId, targetDatetime).then(success => {
                                    if (!success) {
                                        // Se o backend retornou false (regras de negócio não permitiram)
                                        alert('Movimento inválido! O evento voltará ao lugar original.');
                                        return;
                                    }

                                    Livewire.dispatch('refresh-calendar');
                                }).catch(error => {
                                    // Se houver uma falha de rede/servidor 500
                                    alert('Erro de conexão. O evento foi revertido.');
                                }); 
                                     
                                // $wire.moveEvent(eventId, targetDatetime);

                                
                            "
                            >
                            <div class="d-mflex fmlex-wrap justify-content-middle">

                                @foreach($slotEvents as $event)
                          
                            
                                        <a href="#" wire:key="{{$event['type']}}-{{ $event['id'] }}" class="text-wrap px-1 py-2 fw-normal mb-1 w-100  badge justify-content-start bg-{{ $event['color'] ?? '' }} text-white" wire:click="open('{{$event['id']}}', '{{$event['type']}}', '{{$event['start']}}')"

                                            draggable="{{ $event['draggable'] ?? false }}"
                                
                       
                                            ondragstart="
                                                event.dataTransfer.setData('text/plain', '{{ $event['id'] }}');
                                                setTimeout(() => this.style.opacity = '0.4', 0);
                                                // this.classList.add('d-none')
                                            "
                    
                                            ondragend="this.style.opacity = '1'"

                                   
                                        >

                                        
                                         {!! $event['title'] !!}
                                    </a>
                          
                            
                            @endforeach
                        </div>
                            

                        </td>
                      @endforeach

                    </tr>
                   @endforeach
               </tbody>
            @endif

           @if($currentView === 'month')
                <thead>
                   <tr>
                      <th class="text-center">Seg</th>
                      <th class="text-center">Ter</th>
                      <th class="text-center">Qua</th>
                      <th class="text-center">Qui</th>
                      <th class="text-center">Sex</th>
                      <th class="text-center">Sáb</th>
                   </tr>
               </thead>
               <tbody>
                @foreach(collect($days)->chunk(6) as $semana)
                   
                   <tr>
                        @foreach($semana as $day)
                        <td style="height: 150px;width:150px !important;" class="{{ $day->isToday() ? 'bg-yellow-lt' : '' }}">
                            {{ $day->format('d') }}
                            <div>
                                @if($events && isset($events[$day->format('Y-m-d')]))
                                @foreach($events[$day->format('Y-m-d')] as $event)
                                <div class="text-start">
                                    <a href="#" wire:click="open('{{$event['id']}}', '{{$event['type']}}', '{{$event['start']}}')">
                                        <span class="px-1 badgse-pill fw-normal mb-1 w-100  badge justify-content-start badge-outdline  bg-{{ $event['color'] ?? '' }} text-white">
                                            
                                        {!! $event['title'] !!}
                                    </span>
                                    </a>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </td>
                        @endforeach
                   </tr>

                @endforeach
               </tbody>
            @endif


            @if($currentView == 'day')
                <thead>
                   <tr>
                       <th width="1%"></th>
                       @foreach($days as $day)

                       <th class="text-center" width="15%">
                           {{ $day->translatedFormat('D') }} {{ $day->format('d/m') }}
                       </th>
                       @endforeach
                   </tr>
               </thead>
               <tbody>
                @foreach($hours as $hour)
                    <tr>
                        
                        <th class="text-middle">{{ $hour }}</th>
                        <td class="{{ $days[0]->isToday() ? 'bg-yellow-lt' : '' }}">
                            @php
                            $slotEvents = $events[$days[0]->format('Y-m-d'). ' ' . $hour] ?? [];
                            @endphp
                            @foreach($slotEvents as $event)
                            <a href="#" class="" wire:click="open('{{$event['id']}}', '{{$event['type']}}', '{{$event['start']}}')">
                            <div class="card mb-2">
                                  <div class="card-status-start bg-{{ $event['color'] ?? '' }}"></div>
                                  <div class="card-body">{!! $event['title'] !!}</div>
                                </div>
                               
                                            
                             
                     
                                    </a>
                             
                                @endforeach
                            
                        </td>
                   </tr>
                   @endforeach
               </tbody>
            @endif
           </table>
           

           <livewire:calendar.show-class-card wire:key='{{ $currentId }}' />

           <livewire:calendar.form-register-class wire:key='form-{{ $currentId }}' :except="['scheduled']" />

        <livewire:calendar.create-makeup-class />


        <livewire:calendar.show-experimental-class />
        <livewire:calendar.show-simulated-class />
        <livewire:calendar.create-experimental-class />
        <livewire:calendar.register-experimental-class />
        <livewire:registration.update-class />

        @if ($showContextMenu)
        <div class="dropdown-menu show shadow-lg" style="
                    position: fixed;
                    left: {{ $contextMenuX }}px;
                    top: {{ $contextMenuY }}px;
                    z-index: 2000;
                    min-width: 220px;
                " wire:click.outside="$set('showContextMenu', false)">
            <h6 class="dropdown-header">
                {{ \Carbon\Carbon::parse($selectedContextMenuDate)->format('d/m/Y H:i') }}
            </h6>

            <a href="#" class="dropdown-item"
                wire:click.prevent="$dispatch('create-experimental-class', { datetime: '{{ $selectedContextMenuDate }}' })"
                wire:click="$set('showContextMenu', false)">
                <x-icons.calendar class="dropdown-item-icon" />
                Agendar Aula Experimental
            </a>

            <a href="#" class="dropdown-item"
                wire:click.prevent="$dispatch('create-makeup-class', { datetime: '{{ $selectedContextMenuDate }}' })"
                wire:click="$set('showContextMenu', false)">
                <x-icons.calendar class="dropdown-item-icon" />
                Agendar Reposição
            </a>



            {{-- <a href="#" class="dropdown-item text-muted" wire:click.prevent="$set('showContextMenu', false)">
                ✖ Cancelar
            </a> --}}
        </div>
        @endif

</div>
