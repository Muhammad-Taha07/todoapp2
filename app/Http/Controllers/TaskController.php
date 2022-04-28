<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks,]);
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function store()
    {
        // return request()->all();
            $task = Task::create([
            'description' => request('description'),
        ]);
        return redirect('/');
    }
}
//vid https://www.youtube.com/watch?v=4aZwPSUmL5Y&list=PL6p51-RwMZPFbg-52prn13uj7FwhZ2cPx&index=5
