@extends('layouts.site')

@section('content')
    @include('errors.errors')
    <div class="container">
        <h2 class="mb-5">Update Project</h2>
        @if(isset($project->id))
        <form method="post" action="{{ route('project.update', ['id' => $project->id]) }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="@if (isset($project->title)) {{ $project->title }} @endif">
            </div>
            @method('PUT')
            @csrf
            <div class="d-flex justify-content-between">
                <a class="btn btn-primary" href="{{ route('project') }}">Back</a>
                <button type="submit" class="btn btn-primary ml-auto">Update</button>
            </div>
        </form>
        @endif
    </div>
@endsection
