    @extends('layouts.app')
    @section('content')

    <h1 style="margin-top: 30px;">To Do List Application</h1>
    <hr class="solid" style="border-top: 3px solid #bbb;">
    <a href="/tasks/create" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Add a new Task</a>
    {{-- <h3 style="margin-top: 20px; color: green;">Your Task(s)</h1> --}}
    <hr class="solid" style="border-top: 3px solid #bbb;">

    @foreach($tasks as $task)

    <div class="card @if($task->isCompleted()) border-success @endif" style="margin-bottom: 20px;">
    <div class="card-body">

    <p style="font-size: 25px;">{{$task->description}}</p>
    @if (!$task->isCompleted())
    <form action="/tasks/{{$task->id}}" method="POST">
        @method('PATCH')
        @csrf
        <button class="btn btn-dark" input="submit">Complete Task</button>
    </form>

    @else

    <form action="/tasks/{{$task->id}}" method="POST">
        <h3 style="margin-top: 20px; color: green; text-shadow: 2px 2px 5px;">Task Completed</h1>
        @method('DELETE')
        @csrf
        <button class="btn btn-danger" input="submit" style="color: rgb(234, 234, 234);">Delete Task</button>
    </form>

    @endif
    </div>
    </div>

    @endforeach
    @endsection
