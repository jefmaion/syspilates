<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Nova Avaliação Clínica
        </h2>

    </x-page.page-header>

    <x-page.page-body>

        <div class="card">

            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Paciente (<a href="#"
                                wire:click.prevent='$dispatch("create-student")'>Novo Aluno</a>)</label>
                        <x-form.select-user name="form.user_id" wire:model='form.user_id' />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Queixa Principal</label>
                        <x-form.textarea rows="5" name="form.question1" wire:model='form.question1' />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Piora/Melhora</label>
                        <x-form.textarea rows="5" name="form.evolution" wire:model='form.evolution' />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Queixas secundárias</label>
                        <x-form.textarea rows="5" name="form.question2" wire:model='form.question2' />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Traumas/cirurgias</label>
                        <x-form.textarea rows="5" name="form.surgeries" wire:model='form.surgeries' />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Queixas Viscerais</label>
                        <x-form.textarea rows="5" name="form.viscerals_question" wire:model='form.viscerals_question' />
                    </div>
                </div>
                <a href="{{route('osteopathy')}}" class="btn  btn-outline-secondary" wire:navigate>
                    Voltar
                </a>
                <button type="button" class="btn btn-primary" wire:click='store'>
                    <x-page.spinner target="store">
                        <x-icons.success /> Salvar
                    </x-page.spinner>
                </button>
            </div>

        </div>



    </x-page.page-body>
</div>