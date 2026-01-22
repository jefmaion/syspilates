@if($registration)
<x-page.user-block size="lg" class="" :user="$registration->student->user ?? ''">
    <div class="flex-fill">
        <h4 class="font-weight-medium mb-0">
            <strong>{{ $registration->student->user->shortName ?? '' }}</strong>
            - <span class="text-muted">{{ $registration->modality->name }}</span>
        </h4>
        <div class="text-secondary">
            Professor: {{ $instructor->user->shortName ?? null }}
        </div>
        @if(isset($this->props['type_class']) && isset($this->props['type_class_color']) && !empty($this->props['type_class_color']))
        <div>
            <span class="badge badge-outline text-{{ $this->props['type_class_color'] }} ">{{$this->props['type_class']}}</span>
        </div>
        @endif
    </div>
</x-page.user-block>


@endif
