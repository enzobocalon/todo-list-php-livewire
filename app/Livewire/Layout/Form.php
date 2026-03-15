<?php

namespace App\Livewire\Layout;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $title;

    public $content;

    public $completed = false;

    public $id = null;

    #[On('edit-todo')]
    public function loadTodo($id) {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $this->id = $todo->id;
        $this->title = $todo->title;
        $this->content = $todo->content;
        $this->completed = (bool) $todo->completed_at;
        $this->dispatch('end-loading');
    }

    public function submit() {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:1000',
            'completed' => 'boolean'
        ]);

        if ($this->id === null) {
            Todo::create([
                'title' => $this->title,
                'content' => $this->content,
                'completed_at' => $this->completed ? now() : null,
                'user_id' => auth()->id()
            ]);
            $this->dispatch('notify-home', message: 'Atividade criada com sucesso', type: 'success');
        } else {
            $todo = Todo::where('user_id', auth()->id())->findOrFail($this->id);
            $todo->update([
                'title' => $this->title,
                'content' => $this->content,
                'completed_at' => $this->completed ? ($todo->completed_at ?? now()) : null,
                'user_id' => auth()->id()
            ]);

            $this->dispatch('notify-home', message: 'Atividade atualizada com sucesso', type: 'success');
            $this->dispatch('todo-updated');
        }
        $this->dispatch('close-modal');
        $this->reset(['title', 'content', 'completed']);
    }

    public function delete() {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($this->id);
        $todo->delete();
        $this->dispatch('close-modal');
        $this->reset(['title', 'content', 'completed']);
        $this->dispatch('notify-home', message: 'Atividade apagada com sucesso', type: 'success');
    }

    public function render()
    {
        return view('livewire.layout.form');
    }
}
