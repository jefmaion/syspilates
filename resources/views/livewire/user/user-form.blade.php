<div>
    <x-modal.modal class="blur" id="modal-form-user">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> @if($edit) Editar @else Cadastrar @endif Usuário
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <x-form.input-text type="text" wire:model="name" name="name" />
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">CPF</label>
                                <x-form.input-text type="text" wire:model="cpf" name="cpf" />
                            </div>


                        </div>

                        <div class="col">

                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <x-form.input-text type="text" wire:model="phone1" name="phone1" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <x-form.input-text type="text" wire:model="email" name="email" />
                    </div>








                </div>

                <div class="modal-body">
                    <label class="form-label {{($errors->has('userRoles') ? ' is-invalid' : '')}}">Grupo de Permissões</label>
                    @foreach($roles as $role)
                    <label class="form-check ">
                        <input class="form-check-input " wire:key='{{$role->id}}' type="checkbox" wire:model="userRoles"
                            value="{{ $role->name}}">
                        <span class="form-check-label">{{ $role->name }}</span>
                    </label>
                    @endforeach
                    <div class="invalid-feedback">@error('userRoles') {{ $message }} @enderror</div>
                </div>
                <div class="modal-body">
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="sendEmail">
                        <span class="form-check-label">Enviar email com senha de primeiro acesso!</span>
                    </label>

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
