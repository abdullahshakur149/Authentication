@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                    <h4 class="mb-4">{{ Auth::user()->name }}</h4>
                    <div class="alert alert-success" role="alert">
                        <strong>Welcome to your TODO Application!</strong>
                    </div>
                    <p class="mb-4">Start managing your tasks with ease.</p>
                    <a href="{{Route('todos.index')}}" class="btn btn-primary btn-lg">Manage Todos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
