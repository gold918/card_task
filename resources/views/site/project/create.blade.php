@extends('layouts.site')

@section('content')
    @include('errors.errors')
    <div class="container">
        <h2 class="mb-5">Create Project</h2>
        <form method="post" action="{{ route('project.store') }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            @csrf
            <div class="d-flex justify-content-between">
                <a class="btn btn-primary" href="{{ route('project') }}">Back</a>
                <button type="submit" class="btn btn-primary ml-auto">Create</button>
            </div>
        </form>
    </div>
@endsection
