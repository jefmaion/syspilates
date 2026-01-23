
<x-page.user-block size="lg" class="" :user="$student">
    <div class="flex-fill">
        <h3 class="font-weight-medium mb-0">
            <strong>{{ $student->shortName }}</strong>
        </h3>
        <div class="text-secondary text-sm">
            <x-icons.modality /> {{ $modality }} •
            <x-icons.time /> {{ $time }} •
            <x-icons.phone /> {{ $student->phone1 ?? null }} •
            <x-icons.instructor />{{ $instructor }}
        </div>
        <div class="text-secondary">
            {{ $slot }}
        </div>
    </div>
</x-page.user-block>