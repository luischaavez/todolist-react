<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Persist a todo in the database
     * 
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        return Todo::create([
            'body' => $request->body,
            'owner_id' => auth()->id(),
        ]);   
    }

    /**
     * Update the given todo.
     * 
     * @param Request $request
     * @param Todo $todo
     */
    public function update(Todo $todo, Request $request)
    {
        $todo->update([
            'body' => $request->body,
        ]); 
    }

    /**
     * Destroy a todo in the database.
     * 
     * @param Todo $todo
     */
    public function destroy(Todo $todo)
    {
        if($todo->exists) {
            $todo->delete();
        }   
    }
}
