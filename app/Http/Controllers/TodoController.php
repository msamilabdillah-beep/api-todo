<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json([
            'status' => 'success',
            'data' => $todos,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'title' => $request->title, 'is_completed' => false
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil ditambahkan!',
            'data' => $todo,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tugas tidak ditemukan'
            ], 404);
        }

        if ($request->has('title')) {
            $todo->title = $request->title;
        }

        if ($request->has('is_completed')) {
            $todo->is_completed = $request->is_completed;
        }

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil diperbarui!',
            'data' => $todo
        ]);
    }
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tugas tidak ditemukan!',
            ], 404);
        }
        $todo->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil dihapus!',
        ]);
    } 

}
