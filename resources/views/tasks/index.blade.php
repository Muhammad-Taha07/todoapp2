    @extends('layouts.app')
    @section('content')
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end" style="margin-top: 10px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal">Add a task</button>
        </div>
        <h1>Task List</h1>
        <hr class="solid" style="border-top: 3px solid #bbb;">
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

                    <form id="taskForm" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Task Description</label>
                                <input class="form-control" id="description" placeholder="Enter Task here"
                                    name="description" required />
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
                    <th scope="col">ID</th>
                    <th scope="col" style="width: 66%">Description</th>
                    <th scope="col" style="width: 10%">Status</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Delete Panel</th>
                </tr>
            </thead>
            <tbody id="taskTable">
                @foreach ($tasks as $task)
                    {{-- Completing task is being marked --}}
                    <tr id="tblRow-{{$task->id}}">
                        <th scope="row">{{ $task->id }}</th>

                    <td id='description-{{ $task->id }}'
                        style="text-decoration: {{ $task->completed_at == null ? 'none' : 'line-through' }}">
                        {{ $task->description }}
                    </td>
                    <td id="status-{{$task->id}}">
                        {{-- Status Change --}}
                    <span class="badge {{$task->completed_at ? 'badge-success' : 'badge-danger'}}">{{$task->completed_at ? 'Completed' : 'Not Completed'}}</span>
                    </td>
                    {{-- Mark Task Complete Button --}}
                    <td><button class="btn btn-dark markBtn" id="{{$task->id}}">Mark As Completed</button></td>
                    {{-- Delete Button --}}
                    <td><button class="btn btn-danger delBtn" id="{{$task->id}}" style="color: rgb(254, 254, 254);">DeleteTask</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- AJAX --}}
    <script>
        $(function () {

            $('.markComplete').on('click', function(e) {
                e.preventDefault();
                console.log("Asdasdasd");
                $(this).parent().prev().css('text-decoration', 'line-through')
            });

            //AJAX : STATUS CHANGE
            $('.markBtn').on('click', function(e) {
               var id = $(this).attr('id');
            $.ajax({
                url: "/tasks/"+id,
                dataType:"json",
                success: function(response) {
                    console.log(response)
                    var status = response.completed_at ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-danger">Not Completed</span>';
                    $('#status-'+id).html(status);
                    $('#description-'+id).css('text-decoration', response.completed_at ? 'line-through' : 'none');
                }
            });
            });

            //AJAX : DELETE BUTTON
            $('.delBtn').on('click', function(e) {
               var id = $(this).attr('id');
               console.log(id)
            $.ajax({
                url: "/tasks-delete/"+id,
                dataType:"json",
                success: function(response) {
                    console.log(response)
                    $('#tblRow-'+id).hide();
                }
            });
            });
            // AJAX : ADD TASK
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
                            '<td>' +
                            '<span class="badge badge-danger">Not Completed</span>'+
                           '</td>'+
                            '<td>'+
                            '<button class="btn btn-dark markBtn" id='+response.id+'>Mark As Completed</button>'+
                            '</td>'+
                            '<td><form action="/tasks/' + response.id +
                            '" method="POST"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}<button class="btn btn-danger" type="submit">Delete Task</button></form></td>' +
                            '</tr>';
                        $("#taskTable").append(tableRow);
                        $('#taskModal').modal('hide');
                        $('#description').val('');
                    }
                });
            });
        });
    </script>
    @endsection
