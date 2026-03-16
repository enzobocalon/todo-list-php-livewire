<?php

namespace App\Services\Auth;

use App\Models\Todo;

class TodoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getByPage(int $userId, int $perPage = 10)
    {
        return Todo::where('user_id', $userId)->paginate($perPage);
    }

    public function findForUser(int $id, int $userId)
    {
        $todo = Todo::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();

        return $todo;
    }

    public function create(array $data, int $userId): Todo
    {
        return Todo::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'completed_at' => $data['completed'] ? now() : null,
            'user_id' => $userId,
        ]);
    }

    public function update(int $id, int $userId, array $data)
    {
        $todo = $this->findForUser($id, $userId);

        $todo->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'completed_at' => $data['completed']
                ? $todo->completed_at ?? now()
                : null,
        ]);

        return $todo;
    }

    public function delete(int $id, int $userId)
    {
        $todo = $this->findForUser($id, $userId);
        $todo->delete();
        return $todo;
    }
}
