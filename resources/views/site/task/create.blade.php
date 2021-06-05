@extends('layouts.site')

@section('content')
    @include('errors.errors')
    <div class="container">
        <h2 class="mb-5">Create Task</h2>
        @if(isset($project->id))
        <form method="post" action="{{ route('task.store', ['id' => $project->id]) }}" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="preview" class="form-label">Preview</label>
                <textarea rows="3" class="form-control" id="prewiew" name="preview" >{{ old('preview') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea rows="5"  class="form-control" id="text" name="text">{{ old('text') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" class="form-control" id="file" name="file" value="">
            </div>

            @csrf
            <div class="d-flex justify-content-between">
                @if(isset($project->id))
                <a class="btn btn-primary" href="{{ route('task', ['id' => $project->id]) }}">Back</a>
                @endif
                <button type="submit" class="btn btn-primary ml-auto">Create</button>
            </div>
        </form>
        @endif
    </div>
@endsection
