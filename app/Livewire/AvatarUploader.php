<?php

declare(strict_types = 1);

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarUploader extends Component
{
    use WithFileUploads;

    public $photo;

    public $croppedImage;

    public $currentAvatar;

    public function mount($currentAvatar = null)
    {
        $this->currentAvatar = $currentAvatar;
    }

    protected function rules()
    {
        return [
            'photo' => 'required|image|max:2048',
        ];
    }

    public function updatedPhoto()
    {
        $this->validate();

        // abre teu modal Tabler via evento global
        $this->dispatch('show-modal', modal: 'avatarCropModal');
    }

    public function saveCropped()
    {
        if (! $this->croppedImage) {
            return;
        }

        $image = str_replace('data:image/jpeg;base64,', '', $this->croppedImage);
        $image = base64_decode($image);

        $path = 'avatars/' . uniqid() . '.jpg';

        Storage::disk('public')->put($path, $image);

        // aqui depois você liga no User
        $this->currentAvatar = $path;

        $this->reset(['photo', 'croppedImage']);
    }

    public function render()
    {
        return view('livewire.avatar-uploader');
    }
}
