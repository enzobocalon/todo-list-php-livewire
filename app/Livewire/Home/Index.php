<?php

namespace App\Livewire\Home;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[On('notify-home')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.home.index', [
            'todos' => Todo::where('user_id', auth()->id())->paginate(10),
        ]);
    }
}
