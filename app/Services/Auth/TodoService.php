<?php

namespace App\Services\Auth;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class TodoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function findForUser(int $id, int $userId) {
        $todo = Todo::where('user_id', $userId)->find($id);
        if (!$todo) {
            throw new ModelNotFoundException('Tarefa não encontrada');
        }

        return $todo;
    }

    public function create(array $data, int $userId): Todo
    {
        try {
            return Todo::create([
                'title'        => $data['title'],
                'content'      => $data['content'],
                'completed_at' => $data['completed'] ? now() : null,
                'user_id'      => $userId,
            ]);
        } catch (QueryException $e) {
            throw new \RuntimeException("Erro ao criar a tarefa.");
        }
    }

    public function update(int $id, int $userId, array $data) {
        $todo = $this->findForUser($id, $userId);

        try {
            $todo->update([
                'title'        => $data['title'],
                'content'      => $data['content'],
                'completed_at' => $data['completed'] ? ($todo->completed_at ?? now()) : null,
            ]);
        } catch (QueryException $e) {
            throw new \RuntimeException("Erro ao atualizar a tarefa.");
        }

        return $todo;
    }

    public function delete(int $id, int $userId): void
    {
        $todo = $this->findForUser($id, $userId);
        try {
            $todo->delete();
        } catch (QueryException $e) {
            throw new \RuntimeException("Erro ao apagar a tarefa.");
        }
    }
}
