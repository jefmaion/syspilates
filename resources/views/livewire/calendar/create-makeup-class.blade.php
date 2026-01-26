<x-modal.modal class="blur" id="modal-makeup" sise="modal-lg">

    @if($students)

    <form wire:submit="saveMakeup">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.calendar /> Agendar Reposição
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <div class="d-flex aslign-items-center">
                            <span class="avatar rounded-csircle avatar-lg me-2 "><x-icons.calendar /></span>
                            <div class="flex-fill">
                                <h3 class="font-weight-medium mb-1">
                                    <strong>{{ ($datetime) ? ucfirst($datetime->translatedFormat('l, d \d\e F \d\e Y')) : ''; }}</strong>
                                </h3>
                                <div class="text-secondary">{{  $datetime?->format('H:i') }} hrs</div>

                            </div>
                            {{-- <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $user->name }}</a> --}}
                        </div>
            </div>
            <div class="modal-body">




                <div class="mb-3">

                    <label class="form-label">Aluno</label>
                    <x-form.select name="student" wire:model='makeupStudentId' wire:change='listAvailableClass($event.target.value)'>
                        <option value=""></option>
                        @foreach($students as $key => $name)
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </x-form.select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Aula a repor</label>
                    <x-form.select name="student" wire:model='makeupId'>
                        <option value=""></option>
                        @if($makeupClasses)
                            @foreach($makeupClasses as $key => $item)
                            <option value="{{$item->id}}">{{ $item->origin->datetime->format('d/m/Y H:i') . ' - ' . ucfirst($item->origin->datetime->translatedFormat('l')) . ' - ' . $item->origin->status->label() }}</option>
                            @endforeach
                        @endif
                    </x-form.select>


                </div>
                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <x-form.select-instructor wire:model='makeupInstructorId' />
                </div>
                <div class="mb-3">
                    <label class="form-label">Comentários</label>
                    <textarea class="form-control {{ ($errors->has('comments') ? ' is-invalid' : '') }}" rows="5"
                        name="comments" wire:model="comments"></textarea>
                </div>
            </div>

            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    Fechar
                </button>

                <button type="submit" class="btn btn-primary">
                    <x-page.spinner>
                        <span class="d-flex align-items-center">
                            <x-icons.success class="me-2" /> <span>Salvar</span>
                        </span>
                    </x-page.spinner>
                </button>



            </div>
        </div>
    </form>
    @endif

</x-modal.modal>
