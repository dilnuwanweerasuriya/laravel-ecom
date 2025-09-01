<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class ProfilePage extends Component
{
    public $fullName;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $showAddressModal = false;
    public $address;

    public function mount()
    {
        // Pre-fill the full name field with the user's name
        $this->fullName = Auth::user()->name;
    }

    public function updateFullName()
    {
        $this->validate([
            'fullName' => ['required', 'string', 'max:255'],
        ]);

        Auth::user()->update([
            'name' => $this->fullName,
        ]);

        session()->flash('profile_success', 'Name updated successfully!');
    }

    public function openAddressModal($address = null)
    {
        $this->address = $address ?? '';
        $this->showAddressModal = true;
    }

    public function closeAddressModal()
    {
        $this->reset(['address', 'showAddressModal']);
    }

    public function saveAddress()
    {
        $this->validate([
            'address' => ['required', 'string', 'max:255'],
        ]);

        Auth::user()->update([
            'address' => $this->address,
        ]);

        $this->closeAddressModal();
        session()->flash('address_success', 'Address updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', Password::defaults(), 'different:currentPassword'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if (!Hash::check($this->currentPassword, Auth::user()->password)) {
            $this->addError('currentPassword', 'Your current password is incorrect.');
            return;
        }

        Auth::user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        // Reset form fields and validation errors
        $this->reset(['currentPassword', 'newPassword', 'confirmPassword']);
        $this->resetErrorBag();

        session()->flash('password_success', 'Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile-page', [
            'user' => Auth::user()
        ]);
    }
}
