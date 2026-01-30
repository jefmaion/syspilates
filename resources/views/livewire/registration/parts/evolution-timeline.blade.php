<ul class="timeline">
    @foreach($evolutions as $evol)
    <li class="timeline-event">
        <div class="timeline-event-icon bg-x-lt p-4">
            <div class="p-4">{{
                $evol->datetime->format('d/m') }}</div>
        </div>
        <div class="card timeline-event-card">
            <div class="card-body">
                <p class="text-secondary">{{ $evol->evolution }}</p>
                <p>Por <strong>{{ $evol->instructor->user->shortName }}</strong></p>
            </div>
        </div>
    </li>
    @endforeach
</ul>

{{ $evolutions->links() }}