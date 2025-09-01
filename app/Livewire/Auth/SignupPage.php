<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Title('Sign Up - ShopEase')]
class SignupPage extends Component
{
    public $name, $email, $password, $password_confirmation, $terms;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'terms' => 'accepted',
        ]);

        //save user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        //login user
        Auth()->login($user);

        //redirect to home
        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.signup-page');
    }
}
