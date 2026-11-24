<x-modal.modal class="blur" id="modal-single-class" size="modal-lg">
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title align-items-center"><x-icons.calendar /> Agendar Aula Avulsa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Dia</label>
                        <x-form.input-text type="date" name="date" wire:model="date" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Horário</label>
                        <x-form.select-time name="time" wire:model="time" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Aluno (opcional)</label>
                        <select class="form-select @error('student_id') is-invalid @enderror" name="student_id" wire:model="student_id">
                            <option value="">Sem aluno vinculado</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Modalidade</label>
                        <select class="form-select @error('modality_id') is-invalid @enderror" name="modality_id" wire:model="modality_id" @disabled($student_id)>
                            <option value="">Selecione</option>
                            @foreach ($modalities as $modality)
                                <option value="{{ $modality->id }}">{{ $modality->name }}</option>
                            @endforeach
                        </select>
                        @if ($student_id)
                            <small class="form-hint">A modalidade será a da matrícula ativa do aluno.</small>
                        @endif
                        @error('modality_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Professor</label>
                        <select class="form-select @error('instructor_id') is-invalid @enderror" name="instructor_id" wire:model="instructor_id">
                            <option value="">Selecione</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
                            @endforeach
                        </select>
                        @error('instructor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label required">Valor</label>
                        <x-form.input-currency name="value" wire:model="value" />
                        @error('value') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Comentários</label>
                        <textarea class="form-control @error('comments') is-invalid @enderror" rows="4" name="comments" wire:model="comments"></textarea>
                        @error('comments') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">
                    <x-page.spinner target="save"><span class="d-flex align-items-center"><x-icons.success class="me-2" /> Salvar</span></x-page.spinner>
                </button>
            </div>
        </div>
    </form>
</x-modal.modal>
