<div>
    <p class="mb-0"><strong>Histórico Recente</strong></p>
    <table class="table table-striped w-100">
        <tbody>
            @foreach($classes as $_class)
            <tr>
                <td classs="text-center">
                    <div class="mb-1">
                        <strong> {{ $_class->datetime->format('d/m') }} às {{
                            $_class->datetime->format('H:i')}} </strong> -

                        <span>
                            {{ $_class->type->label() }} -
                        </span>

                        <span class="badge bg-{{ $_class->status->color() }} text-{{ $_class->status->color() }}-fg">
                            {{$_class->status->label() }}
                        </span>
                    </div>

                    <div class="mb-1">{{ $_class->evolution }}</div>
                    <div class="text-muted"><small>Por: {{ $_class->instructor->user->name }}</small>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>