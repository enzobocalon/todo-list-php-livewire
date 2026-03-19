<?php

/*
    Lidar com erros no login/signup
*/

namespace App\Livewire\Layout;

use App\Http\Requests\TodoRequest;
use App\Services\Auth\TodoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $title;

    public $content;

    public $completed = false;

    public $id = null;

    protected TodoService $service;

    public function boot(TodoService $todoService)
    {
        $this->service = $todoService;
    }

    #[On('edit-todo')]
    public function loadTodo($id)
    {
        try {
            $todo = $this->service->findForUser($id, auth()->id());
            $this->id = $todo->id;
            $this->title = $todo->title;
            $this->content = $todo->content;
            $this->completed = (bool) $todo->completed_at;
        } catch (ModelNotFoundException $e) {
            $this->dispatch(
                'notify-home',
                message: 'Tarefa não encontrada.',
                type: 'error',
            );
            $this->dispatch('close-modal');
        } finally {
            $this->dispatch('end-loading');
        }
    }

    public function submit()
    {
        $this->validate(TodoRequest::rules(), TodoRequest::customMessages());

        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'completed' => $this->completed,
        ];

        try {
            if ($this->id === null) {
                $this->service->create($data, auth()->id());
                $this->dispatch(
                    'notify-home',
                    message: 'Tarefa criada com sucesso',
                    type: 'success',
                );
            } else {
                $this->service->update($this->id, auth()->id(), $data);
                $this->dispatch(
                    'notify-home',
                    message: 'Tarefa atualizada com sucesso',
                    type: 'success',
                );
            }
        } catch (ModelNotFoundException | \RuntimeException $e) {
            $this->dispatch(
                'notify-home',
                message: $e->getMessage(),
                type: 'error',
            );
        } finally {
            $this->dispatch('close-modal');
            $this->reset(['title', 'content', 'completed']);
        }
    }

    public function delete()
    {
        try {
            $this->service->delete($this->id, auth()->id());
            $this->dispatch(
                'notify-home',
                message: 'Tarefa apagada com sucesso',
                type: 'success',
            );
        } catch (ModelNotFoundException | \RuntimeException $e) {
            $this->dispatch(
                'notify-home',
                message: $e->getMessage(),
                type: 'error',
            );
        } finally {
            $this->dispatch('close-modal');
            $this->reset(['title', 'content', 'completed']);
        }
    }

    public function render()
    {
        return view('livewire.layout.form');
    }
}
