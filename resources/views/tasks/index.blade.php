    @extends('layouts.app')
    @section('content')
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end" style="margin-top: 10px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal">Add a task</button>
        </div>
        <h1>Task List</h1>
        <!-- Modal Start -->
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <form action="/tasks" method="POST"> --}}
                    <form id="taskForm" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Task Description</label>
                                <input class="form-control" id="description" placeholder="Enter Task here" name="description" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal End -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col" style="width: 68%">Description</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Delete Panel</th>
                </tr>
            </thead>
            <tbody id="taskTable">
                @foreach ($tasks as $task)
                    {{-- Completing task is being marked --}}
                    <tr>
                        <th scope="row">{{ $task->id }}</th>
                        <td id='{{ $task->id }}-description'
                            style="text-decoration: {{ $task->completed_at == null ? 'none' : 'line-through' }}">
                            {{ $task->description }}</td>
                        <td>
                            <button class="btn btn-dark markComplete" input="submit">Mark As Completed</button>
                        </td>
                        <td>
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" input="submit" style="color: rgb(254, 254, 254);">Delete
                                    Task</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Creating / Adding a task --}}
        <script>
            $('.markComplete').on('click', function(e) {
                e.preventDefault();

                console.log("Asdasdasd");
                $(this).parent().prev().css('text-decoration', 'line-through')
            });


            $('#taskForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('createTasks') }}",
                    data: $('#taskForm').serialize(),
                    success: function(response) {
                        var tableRow = '<tr>' +
                            '<th scope="row">' + response.id + '</th>' +
                            '<td>' + response.description + '</td>' +
                            '<td><form action="/tasks/' + response.id +
                            '" method="POST"><input type="hidden" name="_method" value="PATCH">{{ csrf_field() }}<button class="btn btn-dark" type="submit">Mark As Completed</button></form></td>' +
                            '<td><form action="/tasks/' + response.id +
                            '" method="POST"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}<button class="btn btn-danger" type="submit">Delete</button></form></td>' +
                            '</tr>';
                        console.log(tableRow);
                        $("#taskTable").append(tableRow);
                        $('#taskModal').modal('hide');
                        $('#description').val('');
                    }
                    //   error: function(error){
                    //     alert('Error');
                    //   }
                });
            });
        </script>
    @endsection



    {{-- <h1 style="margin-top: 30px;">To Do List Application</h1>
    <hr class="solid" style="border-top: 3px solid #bbb;">
    <a href="/tasks/create" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Add a new Task</a>

    <hr class="solid" style="border-top: 3px solid #bbb;">

    @foreach ($tasks as $task)

    <div class="card @if ($task->isCompleted()) border-success @endif" style="margin-bottom: 20px;">
    <div class="card-body">

    <p style="font-size: 25px;">{{$task->description}}</p>
    @if (!$task->isCompleted())
    <form action="/tasks/{{$task->id}}" method="POST">
        @method('PATCH')
        @csrf
        <button class="btn btn-dark" input="submit">Mark Complete</button>
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
    @endforeach --}}
