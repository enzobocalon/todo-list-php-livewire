<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Services\Auth\TodoService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected TodoService $todoService;

    public function __construct(TodoService $service)
    {
        $this->todoService = $service;
    }

    public function create(TodoRequest $request)
    {
        $data = $request->validated();

        $todo = $this->todoService->create($data, $request->user()->id);
        return response()->json(
            [
                'message' => 'Tarefa criada com sucesso',
                'todo' => $todo,
            ],
            200,
        );
    }

    public function get(Request $request)
    {
        return $this->todoService->getByPage($request->user()->id);
    }

    public function update(int $id, TodoRequest $request)
    {
        $data = $request->validated();

        $todo = $this->todoService->update($id, $request->user()->id, $data);

        return response()->json(
            [
                'message' => 'Tarefa atualizada com sucesso.',
                'todo' => $todo,
            ],
            200,
        );
    }

    public function delete(int $id, Request $request)
    {
        $todo = $this->todoService->delete($id, $request->user()->id);

        return response()->json(
            [
                'message' => 'Tarefa apagada com sucesso',
                'todo' => $todo,
            ],
            200,
        );
    }
}
