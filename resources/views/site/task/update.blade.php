@extends('layouts.site')

@section('content')
    @include('errors.errors')
    <div class="container">
        <h2 class="mb-5">Update Task</h2>
        @if(isset($project->id) && isset($task->id))
        <form method="post" action="{{ route('task.update', ['id' => $project->id, 'taskId' => $task->id]) }}" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="
                @if(isset($task->title)) {{ $task->title }} @endif
                ">
            </div>
            <div class="mb-3">
                <label for="preview" class="form-label">Preview</label>
                <textarea rows="3" class="form-control" id="preview" name="preview">
                    @if(isset($task->preview)) {{ $task->preview }} @endif
                </textarea>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label text-left">Text</label>
                <textarea rows="5"  class="form-control" id="text" name="text" >
                     @if(isset($task->text)) {{ $task->text }} @endif
                </textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" class="form-control" id="file" name="file" value="">
            </div>
            @if(isset($task->status))
            <select name="status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option
                    @if($task->status === 'New') {{ 'selected' }} @endif
                value="New">New</option>
                <option
                    @if($task->status === 'In progress') {{ 'selected' }} @endif
                value="In progress">In progress</option>
                <option
                    @if($task->status === 'Done') {{ 'selected' }} @endif
                value="Done">Done</option>
            </select>
            @endif
            @method('PUT')
            @csrf
            <div class="d-flex justify-content-between">
                @if(isset($project->id))
                <a class="btn btn-primary" href="{{ route('task', ['id' => $project->id]) }}">Back</a>
                @endif
                <button type="submit" class="btn btn-primary ml-auto">Update</button>
            </div>
        </form>
        @endif
    </div>
@endsection
