<div>
    <x-modal.modal class="blur" id="modal-calendar-choice" size="modal-xl">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Caledário
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body" style="height: 300px">
                    <div >
                        <livewire:calendar.full-calendar  wire:ignore.self wire:key='calendarRegistration' id="calendarRegistration"  />
                </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>

    </x-modal.modal>
</div>
