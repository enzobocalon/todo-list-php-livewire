<?php

namespace App\Livewire\Auth;

use App\Http\Requests\SignupRequest;
use App\Services\Auth\AuthService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Signup")]
class Signup extends Component
{
    public $name = "";
    public $email = "";
    public $password = "";
    public $password_confirmation = "";

    public function signup(AuthService $service) {
        $data = $this->validate(
            SignupRequest::rules(),
            SignupRequest::customMessages()
        );

        try {
            $user = $service->signup($data);
            return redirect()->route("auth.login")->with("success", "Conta criada com sucesso. Faça login para continuar.");
        } catch (\Exception $e) {
           $this->dispatch('notify-signup',
                message: $e->getMessage(),
                type: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.auth.signup');
    }
}
