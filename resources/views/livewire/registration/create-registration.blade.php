<div>
    <x-modal.modal class="blur" id="modal-create-registration" size="modal-lg">
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
                            <label for="" class="form-label">Aluno (<a href="#"
                                    wire:click.prevent='$dispatch("create-student")'>Novo Aluno</a>)</label>
                            <x-form.select-student name="form.student_id" wire:model='form.student_id' />
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">Modalidade</label>
                            <x-form.select-modality name="form.modality_id" wire:model='form.modality_id' />
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Plano</label>
                            <x-form.select-plan show_value="true" name="form.plan_id" wire:model='form.plan_id'
                                wire:change='setPlan()' />
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="" class="form-label">Valor</label>
                            <x-form.input-text name="form.value" class="currency" wire:model='form.value'
                                wire:change='setPlan()' />
                        </div>

                        <div class="col-md-2 mb-2">
                            <label for="" class="form-label">Dia Vencto.</label>
                            <x-form.input-text name="form.deadline" wire:model='form.deadline'
                                wire:change='setPlan()' />
                        </div>
                        <div class="col-auto mb-3">
                            <label for="" class="form-label">Início das Aulas</label>
                            <x-form.input-text type="date" name="form.start" wire:model='form.start' />
                        </div>



                    </div>
                    <div class="row ">


                        {{-- <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Aulas p/ Semana</label>
                            <x-form.input-text name="form.class_per_week" wire:model.live='form.class_per_week' />
                        </div> --}}

                        <div class="col-auto mb-3 d-flex align-items-end justify-content-end">
                            <x-form.checkbox name="form.paid" wire:model.live='form.paid'>Marcar 1º Mensalidade Paga
                            </x-form.checkbox>
                        </div>
                    </div>
                </div>

                @if (!empty($form->class_per_week))
                <div class="modal-body">
                    <p><strong>Aulas</strong></p>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Horário</th>
                                    <th scope="col">Professor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $form->class_per_week; $i++)
                                    <tr class="">
                                        <td scope="row">
                                            <x-form.select-weekday name="form.schedule.{{ $i }}.weekday"
                                                wire:model='form.schedule.{{ $i }}.weekday' />
                                        </td>
                                        <td>
                                            <x-form.select-time type="time" name="form.schedule.{{ $i }}.time"
                                                wire:model='form.schedule.{{ $i }}.time' />
                                        </td>
                                        <td>
                                            <x-form.select-instructor name="form.schedule.{{ $i }}.instructor_id"
                                                wire:model='form.schedule.{{ $i }}.instructor_id' />
                                        </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if (!empty($form->installments))
                <div class="modal-body">
                    <p><strong>Pagamentos</strong></p>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Pago?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($form->installments as $k=> $inst)
                                <tr>
                                    <td width="20%">
                                        <x-form.input-text type="date" wire:model="form.installments.{{$k}}.date"
                                            name="form.installments.{{$k}}.date" />
                                    </td>
                                    <td width="20%">
                                        <x-form.input-currency wire:model="form.installments.{{$k}}.value"
                                            name="installments_{{$k}}" />
                                    </td>
                                    <td>
                                        <x-form.select-payment-method
                                            wire:model='form.installments.{{$k}}.payment_method'
                                            name="form.installments.{{$k}}.payment_method" />
                                    </td>
                                    <td>
                                        <x-form.checkbox name="form.installments.{{$k}}.payed"
                                            wire:model='form.installments.{{$k}}.payed' />
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

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