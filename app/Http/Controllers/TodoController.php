<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return view('Todos.TodoList')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Todos.TodoCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
            'priority' => ['string', 'required', 'in:low,medium,high'],
        ]);

        // Create the new todo instance
        $todo = Todo::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'priority' => $request['priority']
        ]);

        // return JSON response with message and redirect
        return response()->json([
            'success' => true,
            'message' => 'Todo created successfully',
            'redirect_url' => route('todos.index')
        ]);
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = Todo::find($id);
        return view('Todos.TodoEdit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::findOrFail($id);

        $validateData = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
            'priority' => ['string', 'required', 'in:low,medium,high'],
        ]);

        $todo->title = $validateData['title'];
        $todo->description = $validateData['description'];
        $todo->priority = $validateData['priority'];
        $todo->save();

        // return JSON response with message and redirect
        return response()->json([
            'success' => true,
            'message' => 'Todo Updated successfully',
            'redirect_url' => route('todos.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        // return JSON response with message and redirect
        return response()->json([
            'success' => true,
            'message' => 'Todo Deleted successfully',
            'redirect_url' => route('todos.index')
        ]);
    }
}
