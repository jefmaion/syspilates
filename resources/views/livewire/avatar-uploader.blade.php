<div x-data="avatarCropper()" x-init="init()" class="d-flex align-items-center gap-3">

    {{-- Preview --}}
    @if ($this->currentAvatar)
    <img src="{{ Storage::url($this->currentAvatar) }}" class="rounded-circle border"
        style="width: 96px; height: 96px; object-fit: cover;">
    @else
    <div class="rounded-circle bg-secondary-lt d-flex align-items-center justify-content-center"
        style="width: 96px; height: 96px;">
        <span class="text-muted">Sem foto</span>
    </div>
    @endif

    {{-- Botão --}}
    <button type="button" class="btn btn-outline-primary" @click="$refs.file.click()">
        {{ $this->currentAvatar ? 'Trocar foto' : 'Enviar foto' }}
    </button>

    {{-- Input --}}
    <input type="file" wire:model="photo" x-ref="file" accept="image/*" class="d-none">

    @error('photo')
    <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror

    {{-- Modal --}}
    <div class="modal fade" id="avatarCropModal" tabindex="-1" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajustar foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <div style="max-width: 100%; max-height: 60vh;">
                        <img id="cropper-image" class="img-fluid">
                    </div>

                    <div class="mt-3 text-muted">
                        Arraste e dê zoom para ajustar a foto dentro do quadrado.
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="close()">
                        Cancelar
                    </button>

                    <button class="btn btn-primary" @click="crop()">
                        Recortar e salvar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    @once
    @push('scripts')
    <script>
        function avatarCropper() {
                    return {
                        cropper: null,

                        init() {
                            // escuta quando o Livewire mandar abrir o modal
                            window.addEventListener('show-modal', (e) => {
                                if (e.detail.modal === 'avatarCropModal') {
                                    this.openCropper()
                                }
                            })
                        },

                        openCropper() {
                            const modalEl = document.getElementById('avatarCropModal')
                            const modal = tabler.bootstrap.Modal.getOrCreateInstance(modalEl)

                            const image = document.getElementById('cropper-image')
                            const input = this.$refs.file
                            const file = input.files[0]

                            if (!file) return

                            const reader = new FileReader()
                            reader.onload = (e) => {
                                image.src = e.target.result

                                this.$nextTick(() => {
    console.log('DEBUG Cropper =', window.Cropper)

    if (typeof window.Cropper !== 'function') {
        alert('❌ CropperJS NÃO carregou. Veja o console.')
        return
    }

    this.cropper = new window.Cropper(image, {
        aspectRatio: 1,
        viewMode: 1,
        autoCropArea: 1,
        movable: true,
        zoomable: true,
        scalable: false,
        cropBoxResizable: false,
        cropBoxMovable: false,
        dragMode: 'move',
        background: false,
        responsive: true,
    })

    modal.show()
})
                            }

                            reader.readAsDataURL(file)
                        },

                        close() {
                            if (this.cropper) {
                                this.cropper.destroy()
                                this.cropper = null
                            }

                            window.dispatchEvent(new CustomEvent('hide-modal', {
                                detail: { modal: 'avatarCropModal' }
                            }))
                        },

                        crop() {
                            if (!this.cropper) return

                            const canvas = this.cropper.getCroppedCanvas({
                                width: 256,
                                height: 256,
                                imageSmoothingQuality: 'high',
                            })

                            const base64 = canvas.toDataURL('image/jpeg', 0.9)

                            @this.set('croppedImage', base64)
                            @this.call('saveCropped')

                            this.close()
                        }
                    }
                }
    </script>
    @endpush
    @endonce
</div>
