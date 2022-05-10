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
    }
//Showing all task
    public function allTasks()
    {
        try {
            $tasks = $this->task->all();

            return response()->json([
                "success" => true,
                "status" => 200,
                "message" => "Task fetched successfully",
                "data" => $tasks
            ], 200);
            }

        catch (Exception $exception) {
            return response()->json([
                "success" => false,
                "status" => 500,
                "message" => $exception
            ], 500);
        }
    }
    public function create()
    {
        return view('tasks.create');
    }

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

    public function store()
    {
        // return request()->all();
        $task = Task::create([
            'description' => request('description'),
        ]);
        return $task;
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

    //Deleting function for
    public function delete($id)
    {

        // $task = Task::find($id)->dele;
        $task = Task::where('id', $id)->first();
        $task->delete();
        return redirect('/');
    }
}
