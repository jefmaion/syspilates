<x-table.table :search="false" class="mb-3 tablse-sm">
    <thead>
        <tr>
            <th style="cursor:pointer" wire:click="sortBy('datetime')">Dia</th>
            <th style="cursor:pointer" wire:click="sortBy('datetime')">Horário</th>
            <th style="cursor:pointer" wire:click="sortBy('type')">Tipo</th>
            <th style="cursor:pointer" wire:click="sortBy('instructor_id')">Instrutor</th>
            <th style="cursor:pointer" wire:click="sortBy('status')">Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $date => $class)
        <tr>
            <td scope="row">
                {{ $class->datetime->format('d/m/y') }} / 
                {{ ucfirst($class->datetime->isoFormat('ddd')) }}
            </td>
            <td>
                {{ $class->datetime->format('H:i') }}
            </td>
            <td>
                {{ $class->type->label() }}
            </td>
            <td>
                <x-page.user-avatar size="xs" :user="$class->instructor->user">
                    <span class="small">
                        {{ $class->instructor->user->shortName }}
                    </span>
                </x-page.user-avatar>
            </td>
            <td>
                <x-page.badge icon="{{ $class->status->icon() }}" color="{{ $class->status->color() }}">
                    {{ $class->status->label() }}
                </x-page.badge>
            </td>
            <td class="text-center">
                <div class="btn-actions">
                    <a class="btn btn-action text-center" href="#" wire:click="editClass({{ $class->id }})">
                        <x-icons.edit />
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table.table>
<div class="mx-3">
    {{$classes->links()}}
</div>