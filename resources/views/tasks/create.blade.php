@extends('layouts.app')
@section('content')

    <h1>New Task</h1>
    <hr class="solid" style="border-top: 3px solid #bbb;">
    <form action="/tasks" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Task Description</label>
            <input class="form-control" name="description" required/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Create Task</button>
        </div>
        <hr class="solid" style="border-top: 3px solid #bbb;">
    </form>
    @endsection
