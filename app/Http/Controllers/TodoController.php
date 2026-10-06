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
}
