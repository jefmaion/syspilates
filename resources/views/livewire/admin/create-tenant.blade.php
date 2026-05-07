<div>
    <x-modal.modal class="blur" id="modal-form-tenant" size="modal-lg">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Nova Matrícula
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="" class="form-label">Nome do Estúdio</label>
                            <x-form.input-text name="company_name" wire:model='company_name' />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Subdomínio</label>
                            <x-form.input-text name="subdomain" wire:model='subdomain' />
                        </div>
                    </div>

                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Responsável</label>
                            <x-form.input-text name="name" wire:model='name' />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Telefone</label>
                            <x-form.input-text name="phone" wire:model='phone' />
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="" class="form-label">Email</label>
                            <x-form.input-text name="email" wire:model='email' />
                        </div>
                    </div>

                    @if(empty($tenant))
                    <label class="form-check mt-3">
                        <input class="form-check-input" wire:model='create_database' type="checkbox" checked>
                        <span class="form-check-label">Criar banco de dados</span>
                    </label>
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove>Salvar</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm"></span>
                            Salvando...
                        </span>
                    </button>
                </div>
            </div>
        </form>

    </x-modal.modal>
</div>