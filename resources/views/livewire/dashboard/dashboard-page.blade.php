<div>
    @section('title') Alunos @endsection
    @section('header')
    <script src="https://cdn.jsdelivr.net/npm/echarts@6.0.0/dist/echarts.min.js"></script>
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Bem Vindo {{ auth()->user()->shortName }}
        </h2>
    </x-page.page-header>

    <x-page.page-body>
        <div class="row mb-3">
            <div class="col-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                        </path>
                                        <path d="M12 3v3m0 12v3"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">ALUNOS</div>
                                <div class="h1">132</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-teal text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                        </path>
                                        <path d="M12 3v3m0 12v3"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">RECEBER HOJE</div>
                                <div class="h1">132</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                        </path>
                                        <path d="M12 3v3m0 12v3"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">PAGAR HOJE</div>
                                <div class="h1">132</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                        </path>
                                        <path d="M12 3v3m0 12v3"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">PAGAR HOJE</div>
                                <div class="h1">132</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text">Receitas x Despesas</h3>
                    </div>
                    <div class="card-body">
                        <livewire:dashboard.charts.expenses />
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        asd
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        asd
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        asd
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        asd
                    </div>
                </div>
            </div>
        </div>
    </x-page.page-body>


</div>