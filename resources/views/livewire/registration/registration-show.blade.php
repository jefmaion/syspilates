<div wire:key="registration-show-{{ $registration->id }}">

    @section('title')
    Detalhes da Matrícula
    @endsection
    <x-page.page-header>
        <div class="page-pretitle">Overview</div>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes da Matrícula
        </h2>

    </x-page.page-header>

    <x-page.page-body>
        <div class="row">
            <div class="col-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3">
                            {{ $registration->student->user->initials }}
                        </span>
                        <h3 class="m-0 mb-1"><a href="#">{{ $registration->student->user->name }}</a></h3>
                        <div class="text-secondary">{{ $registration->modality->name }}</div>
                        {{-- <div class="mt-3">
                            <span class="badge bg-purple-lt">Owner</span>
                        </div> --}}
                        <div class="mt-3 text-left">
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Aluno desde:</strong></span>
                                <span>{{ $registration->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Status</strong></span>
                                <span><span class="badge bg-green-lt">Ativo</span></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Início do Plano</strong></span>
                                <span>{{ $registration->plan->start->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Fim do Plano</strong></span>
                                <span>{{ $registration->plan->end->format('d/m/Y') }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Presenças</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Faltas</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Reposições</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="card-btn">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2 text-muted icon-3">
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                </path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>
                            Email
                        </a>
                        <a href="#" class="card-btn">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/phone -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2 text-muted icon-3">
                                <path
                                    d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                </path>
                            </svg>
                            Call
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nasv-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>Home
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>Profile
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/activity -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                    </svg>Activity
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                                <h4>Home tab</h4>

                                <x-table.table>
                                        <thead>
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Horário</th>
                                                <th scope="col">Instrutor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classes as $class)
                                            <tr class="">
                                                <td scope="row">{{ $class['date']->format('d/m/Y') }}</td>
                                                <td>{{ $class['time'] }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm me-2  {{ ($class['instructor']->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{ $class['instructor']->user->initials }}</span>
                                                        {{ $class['instructor']->user->name }}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </x-table.table>

                                {{ $classes->links() }}

                            </div>
                            <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
                                <h4>Profile tab</h4>
                                <div>
                                    <a href="#"
                                        wire:click="$dispatch('edit-student', { student: {{ $registration->student->id }} })">Editar</a>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
                                <h4>Activity tab</h4>
                                <div>
                                    Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi
                                    sit mauris accumsan nibh habitant senectus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('registration') }}" class="me-2" wire:navigate>Voltar</a>
    </x-page.page-body>
</div>