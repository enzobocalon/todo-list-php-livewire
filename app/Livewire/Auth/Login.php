<?php

namespace App\Livewire\Auth;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Login")]
class Login extends Component
{

    public $email = "";
    public $password = "";

    public function login() {
        $credentials = $this->validate(
            LoginRequest::rules(),
            LoginRequest::customMessages()
        );

        try {
            if (Auth::attempt($credentials, true)) {
                session()->regenerate();
                return redirect()->route('home.index');
            } else {
                $this->dispatch('notify-login',
                    message: 'Credenciais inválidas.',
                    type: 'error',
                );
            }

        } catch (\Exception $e) {
            $this->dispatch('notify-login',
                message: $e->getMessage(),
                type: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
