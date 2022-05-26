<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Exception;

class TaskController extends Controller
//Dependency Injection
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks,]);
        return redirect('/');
    }

//Showing all task via an API
    // public function allTasks()
    // {
    //     try {
    //         $tasks = $this->task->all();

    //         return response()->json([
    //             "success" => true,
    //             "status" => 200,
    //             "message" => "Task fetched successfully",
    //             "data" => $tasks
    //         ], 200);
    //         }

    //     catch (Exception $exception) {
    //         return response()->json([
    //             "success" => false,
    //             "status" => 500,
    //             "message" => $exception
    //         ], 500);
    //     }
    // }

    //Viewing Task List
    public function create()
    {
        return view('tasks.create');
    }

    //Inserting Tasks using API (DISABLED)
    public function storeData(Request $request)
    {
        try{
            $task = Task::create([
                'description' => $request->description,
            ]);

            return response()->json([
                "success" => true,
                "status"=> 200,
                "message"=> "Data has been added",
                "data" => $task
            ], 200);

        }
        catch (Exception $exception){
            return response()->json([
                "success" => false,
                "status" => 500,
                "message" => $exception
            ],500);
        }
    }
    //Inserting Task into Database
    public function store()
    {
        $task = Task::create([
            'description' => request('description'),
        ]);
        return $task;
    }

    //Updating Task Status
    public function update($id)
    {
        $task = Task::where('id', $id)->first();
        if($task->completed_at)
        {
            $task->completed_at = null;
        }
        else{
            $task->completed_at = now();
        }
        $task->save();
        return $task;
    }

    //Deleting function for
    public function delete($id)
    {
        $task = Task::where('id',$id)->first();
        $task->delete();
        return $task;
    }
}
