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
        return Todo::create([
            'body' => $request->body,
        ]);   
    }
}
