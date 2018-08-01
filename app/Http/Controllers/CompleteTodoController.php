<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class CompleteTodoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Todo $todo)
    {
        if($todo->exists) {
            $todo->markAsComplete();
        }   
    }
}
