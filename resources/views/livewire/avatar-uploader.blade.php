<x-modal.modal class="blur" id="modal-upload-avatar" sizse="modal-lg">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title align-items-center" id="modalTitleId">
                <x-icons.calendar /> Upload de Avatar
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" id="avatarInput" accept="image/*" class="form-control" style="display:none;">

            <!-- Botão para abrir câmera -->

            <div class="camera-container mt-3" style="display:none;">
                <video id="camera" autoplay playsinline style="max-width:100%;"></video>
                <div class="d-grid gap-2">
                    <button type="button" id="takePhoto" class="btn btn-success btn-block mt-2">Tirar Foto</button>
                    <button type="button" id="cancelPhoto" class="btn btn-secondary btn-block mt-2">Cancelar</button>
                </div>
                <canvas id="snapshot" style="display:none;"></canvas>
            </div>

            <div class="img-container mt-3">
                <img @if(!empty($user->avatar)) src="{{ asset('storage/'.$user->avatar) }}" @endif id="avatarPreview"
                alt="Avatar">
            </div>



            <div class="mt-3" id="controls" style="display:none">
                <button type="button" id="zoomIn" class="btn btn-sm btn-secondary">Zoom +</button>
                <button type="button" id="zoomOut" class="btn btn-sm btn-secondary">Zoom -</button>
                <button type="button" id="rotate" class="btn btn-sm btn-secondary">Girar</button>
                <button type="button" id="reset" class="btn btn-sm btn-secondary">Resetar</button>
            </div>



            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary btn-block" id="selectFile">
                    Selecionar Foto
                </button>

                <button type="button" class="btn btn-primary" id="openCamera">
                    Câmera
                </button>
            </div>



        </div>
        <div class="modal-footer border-0 bg-transparent">
            <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                Fechar
            </button>

            <button type="button" class="btn btn-purple" id="saveBtn">
                <x-page.spinner>Salvar</x-page.spinner>
            </button>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        const file = document.getElementById('selectFile');
        const input     = document.getElementById('avatarInput');
        const controls     = document.getElementById('controls');
    const preview   = document.getElementById('avatarPreview');
    const saveBtn   = document.getElementById('saveBtn');
    const zoomIn    = document.getElementById('zoomIn');
    const zoomOut   = document.getElementById('zoomOut');
    const rotate    = document.getElementById('rotate');
    const reset     = document.getElementById('reset');
    const openCamera= document.getElementById('openCamera');
    const camera    = document.getElementById('camera');
    const takePhoto = document.getElementById('takePhoto');
    const cancelPhoto = document.getElementById('cancelPhoto');
    const snapshot  = document.getElementById('snapshot');
    const cameraContainer = document.querySelector('.camera-container');

    let cropper;
    let stream;

    // @if(!empty($user->avatar))
    //     initCropper('{{ asset('storage/'.$user->avatar) }}')   
    //     alert('aop') 
    // @endif

    controls.style.display = 'none';

    function initCropper(src) {
        preview.src = src;
        preview.onload = () => {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            cropper = new Cropper(preview, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                movable: true,
                zoomable: true,
                rotatable: true,
                scalable: true,
                cropBoxMovable: false,
                cropBoxResizable: false,
                dragMode: 'move'
            });

            controls.style.display = 'block';
        };
    }

    // Upload de arquivo
    input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = event => initCropper(event.target.result);
        reader.readAsDataURL(file);
    });

    // Abrir câmera
    openCamera.addEventListener('click', async () => {
        try {

             if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            preview.src = ''

            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            camera.srcObject = stream;
            cameraContainer.style.display = 'block';
           
        } catch (err) {
            console.error("Erro ao acessar câmera:", err);
        }
    });

    cancelPhoto.addEventListener('click', async () => {
        try {
            cameraContainer.style.display = 'none';
        } catch (err) {
            console.error("Erro ao acessar câmera:", err);
        }
    });

    file.addEventListener('click', async () => {
        try {
             if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            preview.src = ''
            input.click()
        } catch (err) {
           
        }
    });

    // Tirar foto
    takePhoto.addEventListener('click', () => {
        const context = snapshot.getContext('2d');
        snapshot.width  = camera.videoWidth;
        snapshot.height = camera.videoHeight;
        context.drawImage(camera, 0, 0, snapshot.width, snapshot.height);
        const dataUrl = snapshot.toDataURL('image/png');
        initCropper(dataUrl);
        // opcional: parar câmera após tirar foto
        stream.getTracks().forEach(track => track.stop());
        cameraContainer.style.display = 'none';
    });

    // Controles
    zoomIn.onclick = () => cropper && cropper.zoom(0.1);
    zoomOut.onclick = () => cropper && cropper.zoom(-0.1);
    rotate.onclick = () => cropper && cropper.rotate(90);
    reset.onclick = () => cropper && cropper.reset();

    // Salvar
    saveBtn.onclick = () => {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
            const base64 = canvas.toDataURL('image/png');
            @this.set('croppedImage', base64);
            @this.call('save');
        }
    };
    </script>
    @endpush
</x-modal.modal>