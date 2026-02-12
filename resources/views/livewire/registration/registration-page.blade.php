<div>
    @section('title') Matrículas @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Matrículas
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-registration")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Nova Matrícula
                </a>
                <a wire:click='$dispatch("create-registration")' class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
            <livewire:registration.create-registration />
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>

        <div class="row mb-3">
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-teal"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-teal-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">Ativas/Em Andamento</div>
                                <div class="font-weight-medium h2">
                                    {{$active}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-warning"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-warning-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">À Vencer</div>
                                <div class="font-weight-medium h2">
                                    {{$expiring}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">Vencidas</div>
                                <div class="font-weight-medium h2">
                                    {{$expired}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="col">
                    <div class="card card-sm">
                        <div class="card-status-top bg-secondary"></div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-secondary-lt avatar">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M12 5l0 14"></path>
                                            <path d="M18 11l-6 -6"></path>
                                            <path d="M6 11l6 -6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="text-secondary">Expirados</div>
                                    <div class="font-weight-medium h2">
                                        {{$canceled}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col">
                    <div class="card card-sm">
                        <div class="card-status-top bg-secondary"></div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-secondary-lt avatar">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M12 5l0 14"></path>
                                            <path d="M18 11l-6 -6"></path>
                                            <path d="M6 11l6 -6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="text-secondary">Mensalidades Vencidas</div>
                                    <div class="font-weight-medium h2">
                                        {{$late}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{--
                <x-table.table-search /> --}}
                <div class="row flex-fill">
                    <div class="col-auto">
                        <x-form.select-duration wire:model.live='duration' placeholder="opa" />
                    </div>
                    <div class="col-auto">
                        <x-form.select-modality wire:model.live='modality_id' />
                    </div>
                    <div class="col">
                        <input type="text" wire:model.live='search' class="form-control w-100"
                            placeholder="Pesquisar aluno...">
                    </div>
                </div>
            </div>
            <div class="card-body">

                <x-table.table :search="false" class="fs-4 table-ssm">
                    <thead>
                        <tr>
                            <th scope="col" wsidth="50%">Aluno</th>
                            <th>Modalidade</th>
                            <th>Plano</th>
                            <th>Status</th>
                            <th>Mensalidade</th>
                            <th>Próx.Aula</th>
                            <th>Vigência</th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($registrations as $item)
                        <tr>
                            <td>

                                <div class="d-flex align-items-center">
                                    <x-page.avatar :user="$item->student->user" />
                                    <a href="{{ route('registration.show', $item) }}" wire:navigate>{{
                                        $item->student->user->name }}</a>
                                </div>

                            </td>
                            <td>{{ $item->modality->name }}</td>

                            <td>
                                {{ $item->planDescription }}
                            </td>


                            <td>
                                <x-page.status color="{{ $item->registrarionStatus->color() }}">
                                    {{ $item->registrarionStatus->label() }}
                                </x-page.status>

                            </td>
                            <td>
                                @if ($item->hasUnpaidTransactions)
                                <x-page.badge color="danger">
                                    Pendente
                                </x-page.badge>
                                @else
                                <x-page.badge>
                                    Em dia
                                </x-page.badge>
                                @endif

                            </td>
                            <td>
                                {{ $item->nextClass?->datetime->format('d/m/y H\h') }}
                            </td>
                            <td>
                                <div>{{ $item->start->format('d/m/y') }} - {{ $item->end->format('d/m/y') }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                <div class="mt-3">
                    {{ $registrations->links() }}
                </div>
            </div>
        </div>

        <x-modal.modal-delete />

    </x-page.page-body>
</div>