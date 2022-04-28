    @extends('layouts.app')
    @section('content')

    <h1 style="margin-top: 30px;">To Do List Application</h1>
    <h3 style="margin-top: 20px; color: green;">Your Task(s)</h1>
    <a href="/tasks/create" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Add a new Task</a>

    @foreach($tasks as $task)

    <div class="card @if($task->isCompleted()) border-success @endif" style="margin-bottom: 20px;">
    <div class="card-body">
    <p>{{$task->description}}</p>
{{-- <span class="badge badge-success" style="color: rgb(8, 141, 41);">Completed</span> --}}

    @if (!$task->isCompleted())
    <form action="/tasks/{{$task->id}}" method="POST">
        @method('PATCH')
        @csrf
        <button class="btn btn-dark" input="submit">Complete Task</button>
    </form>

    @else

    <form action="/tasks/{{$task->id}}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger" input="submit" style="color: rgb(234, 234, 234);">Delete Task</button>
    </form>

    @endif
    </div>
    </div>

    @endforeach
    @endsection
