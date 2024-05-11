@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Edit Todo</h2>
                    <form id="edit-todo-form" action="{{ route('todos.update', ['id' => $todo->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $todo->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="3" required>{{ $todo->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority:</label>
                            <select id="priority" name="priority" class="form-control" required>
                                <option value="low" {{ $todo->priority === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $todo->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $todo->priority === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Update Todo</button>
                    </form>
                   
                    
                
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    $(document).on('submit', '#edit-todo-form', function (e) {
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
                     text: "response.success"
                    });           
                            setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 3000);
                } else {
                    // Handle error if needed
                    console.error("Error occurred:", response);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors if needed
                console.error("AJAX error occurred:", status, error);
            }
        });
    });
</script>
@endsection
