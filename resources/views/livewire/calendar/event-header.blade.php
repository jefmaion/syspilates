@if($registration)
<x-page.user-block size="lg" class="" :user="$registration->student->user ?? ''">
    <div class="flex-fill">
        <h3 class="font-weight-medium mb-0">
            <strong>{{ $registration->student->user->shortName ?? '' }}</strong>
        </h3>
        <div class="text-secondary text-sm">
            
            <x-icons.modality /> {{ $registration->modality->name }} • 
            <x-icons.time /> {{ $datetime->format('H:s') }} • 
            <x-icons.phone /> {{ $registration->student->user->phone1 ?? null }} • 
            <x-icons.instructor />{{ $instructor->user->shortName }}
        </div>
        @if(isset($this->props['type_class']) && isset($this->props['type_class_color']) && !empty($this->props['type_class_color']))
        <div>
            <span class="badge badge-outline text-{{ $this->props['type_class_color'] }} ">{{$this->props['type_class']}}</span>
        </div>
        @endif
    </div>
</x-page.user-block>


@endif
