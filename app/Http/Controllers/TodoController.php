<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    //

    public function index()
    {
        $todos = Todo::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Danh sách todo',
            'status_code' => 200,
            'data' => TodoResource::collection($todos),
        ], 200);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        return response()->json(
            [
                'success' => true,
                'message' => 'Chi tiết todo',
                'status_code' => 200,
                'data' => new TodoResource($todo),
            ],
            200
        );
    }

    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::find($id);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        $todo->update($data);
        return response()->json(
            [
                'success' => true,
                'message' => 'Cập nhật thành công',
                'status_code' => 200,
                'data' => $todo,
            ],
            200
        );
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Not found todo with id:' . $id,
                    'status_code' => 422,
                    'data' => null,
                ],
                422
            );
        }
        $todo->delete();
        return response()->json(
            [],
            204
        );
    }

    public function store(TodoRequest $request)
    {
        //validate data trước khi insert vào todo
        $todo = Todo::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Thành công',
                'status_code' => 201,
                'data' => $todo,
            ],
            201
        );
    }
}
