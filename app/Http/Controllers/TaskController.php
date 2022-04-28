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

    //updating function for editing & updating task
    public function update($id)
    {
        $task = Task::where('id', $id)->first();
        $task->completed_at = now();
        $task->save();
        // return dd($task); die dump to check if we're receiving data in array
        return redirect('/');
    }

    public function delete($id)
    {
        // $task = Task::find($id)->dele;
        $task = Task::where('id', $id)->first();
        $task->delete();
        return redirect('/');
    }
}

