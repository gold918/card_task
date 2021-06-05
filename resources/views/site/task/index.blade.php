@extends('layouts.site')

@section('content')
    @if(isset($project->id))
        <div class="container">
            <div class="row justify-content-between">
                <a class="btn btn-success col-md-2 col-sm-4" href="{{ route('task.user.edit', ['id' => $project->id]) }}" role="button">Add users</a>
                <div class="dropdown col-md-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        sort
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('task', ['id' => $project->id]) }}">All</a></li>
                        <li><a class="dropdown-item" href="{{ route('task.sort.status', ['id' => $project->id, 'status' => 'new']) }}">New</a></li>
                        <li><a class="dropdown-item" href="{{ route('task.sort.status', ['id' => $project->id, 'status' => 'in-progress']) }}">In progress</a></li>
                        <li><a class="dropdown-item" href="{{ route('task.sort.status', ['id' => $project->id, 'status' => 'done']) }}">Done</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
    @include('errors.errors')
    <section class="container content">
        @if(isset($project->title))
        <h2 class="text-center mb-5">Tasks of the project {{ $project->title }}</h2>
        @endif
        <div class="row">
            @if(isset($project->id))
            <div class="col-sm-6 col-md-4 col-lg-3 gy-2">
                <div class="card d-flex flex-column justify-content-center align-items-center h-100">
                    <a href="{{ route('task.create', ['id' => $project->id]) }}" class="add_card">
                        <img src="{{ asset('img/add.png') }}" width="120px" alt="">
                    </a>
                </div>
            </div>
            @endif
            @if(isset($tasks) && is_object($tasks))
                @foreach( $tasks as $task )
                <div class="col-sm-6 col-md-4 col-lg-3 gy-2">
                    <div class="task__card card d-flex flex-column h-100">
                        @if(isset($project->id) && (isset($task->id)))
                        <div class="d-flex justify-content-end">

                            <a href="{{ route('task.update', ['id' => $project->id, 'taskId' => $task->id]) }}" class="card__change">
                                <img class="d-block" src="{{ asset('img/edit.png') }}" width="17px" alt="">
                            </a>
                            <form method="post" action="{{ route('task.delete', ['id' => $project->id, 'taskId' => $task->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn-close card__change" ></button>
                            </form>
                        </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            @if(isset($task->title))
                            <h5 class="card-title mb-2">{{ $task->title }}</h5>
                            @endif
                            @if(isset($task->preview))
                            <p class="card-text">{{ $task->preview }}</p>
                            @endif
                            @if(isset($task->status))
                                    <div class="progress mb-2">
                                        @switch($task->status)
                                            @case('New')
                                            <div class="progress-bar bg-warning" role="progressbar" style="width:100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ $task->status }}</div>
                                            @break
                                            @case('In progress')
                                            <div class="progress-bar bg-success" role="progressbar" style="width:50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">{{ $task->status }}</div>
                                            @break
                                            @case('Done')
                                            <div class="progress-bar bg-info" role="progressbar" style="width:100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ $task->status }}</div>
                                            @break
                                        @endswitch
                                    </div>
                            @endif
                            @if(isset($project->id) && (isset($task->id)))
                            <a href="{{ route('task.show', ['id' => $project->id, 'taskId' => $task->id]) }}" class="btn btn-primary d-block mt-auto">Description</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
