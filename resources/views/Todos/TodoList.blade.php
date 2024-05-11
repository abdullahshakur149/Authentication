@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todos</div>

                <div class="card-body">
                    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Add Todo</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">                                
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($todos as $todo)
                                    <tr>
                                        <td>{{ $todo->id }}</td>
                                        <td>{{ $todo->title }}</td>
                                        <td>{{ $todo->description }}</td>
                                        <td>
                                            <span class="badge badge-priority {{ $todo->priority === 'low' ? 'badge bg-success' : ($todo->priority === 'medium' ? 'badge bg-warning' : 'badge bg-danger') }}">
                                                {{ ucfirst($todo->priority) }}
                                            </span>
                                            
                                        </td>
                                        
                                        <td>
                                            @method('GET')
                                            <a href="{{ route('todos.edit', ['id' => $todo->id]) }}" class="btn btn-sm btn-primary">Update</a>
                                            

                                            <form action="{{ route('todos.delete', ['id' => $todo->id]) }}" method="POST" id="delete-todo" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    $(document).on('submit', '#delete-todo', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success === true) {
                    Swal.fire({
                        icon: "success",
                        title: "success",
                     text: response.message
                    });           
                            setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 3000);
                } else {
                    Swal.fire({
  icon: "error",
  title: "error",
  text: "error creating the file",
});                }
            },
            error: function (xhr, status, error) {
                // Handle errors if needed
                console.error("AJAX error occurred:", status, error);
            }
        });
    });
</script>

@endsection
