<div class="page-header d-print-none">
    <div class="container-fluid">
          <livewire:alert />  
        <div class="row g-2 align-items-center">
            <div class="col">
                {{$slot}}
            </div>
            @isset($actions)
            <div class="col-auto ms-auto d-print-none">
                {{ $actions }}
            </div>
            @endisset
        </div>

        
    </div>
</div>