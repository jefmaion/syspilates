<?php

declare(strict_types = 1);

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class AvatarUploader extends Component
{
    public $croppedImage;

    public User $user;

    #[On('show-upload-avatar')]
    public function open()
    {
        $this->dispatch('show-modal', modal:'modal-upload-avatar');
    }

    public function save()
    {
        if ($this->croppedImage) {
            $image     = preg_replace('#^data:image/\w+;base64,#i', '', $this->croppedImage);
            $imageName = 'avatars/' . uniqid() . '.png';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $this->user->update(['avatar' => $imageName]);
        }

        $this->dispatch('hide-modal', modal:'modal-upload-avatar');
        $this->dispatch('upload-avatar-finished');
    }

    public function render()
    {
        return view('livewire.avatar-uploader');
    }
}
