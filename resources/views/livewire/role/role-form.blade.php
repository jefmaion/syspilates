<div>
  <x-modal.modal class="blur" id="modal-form-role" >
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> @if($edit) Editar @else Cadastrar @endif Grupo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                <label class="form-label">Nome do Grupo</label>
                <x-form.input-text type="text" wire:model='roleName' name="roleName" disabled="{{ ((in_array($roleName, $systemRoles)) ? 'disabled' : '')}}" />
            </div>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                     @if($role && !in_array($role->name, $systemRoles))
                    <button type="button" wire:click='removeRole()' class="btn  btn-danger" data-bs-dismiss="modal">
                        Excluir
                    </button>
                    @endif
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
