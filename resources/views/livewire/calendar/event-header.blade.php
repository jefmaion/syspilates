@if($registration)
<x-page.user-block size="lg" class="" :user="$registration->student->user ?? ''">
    <div class="flex-fill">
        <h4 class="font-weight-medium mb-0">
            <strong>{{ $registration->student->user->shortName ?? '' }}</strong>
            - <span class="text-muted">{{ $registration->modality->name }}</span>
        </h4>
        <div class="text-secondary">
            Professor: {{ $instructor->user->shortName }}
        </div>


    </div>
</x-page.user-block>


@endif