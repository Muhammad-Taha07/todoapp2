@extends('layouts.app')
@section('content')
    <br>
    <h1 style="text-decoration-style: solid">Add a New Task</h1>
    <ul style=“list-style-type:circle">
        <li style="text">This section is to load a new Task into the Application.</li></ul>
    <hr class="solid" style="border-top: 3px solid #bbb;">
    <form action="/tasks" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Task Description</label>
            <input class="form-control" placeholder="Enter Task here" name="description" required/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Create Task</button>
        </div>
        <hr class="solid" style="border-top: 3px solid #bbb;">
    </form>
    @endsection
