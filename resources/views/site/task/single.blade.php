@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($task->title))
            <h2>{{ $task->title }}</h2>
            @endif
            @if(isset($task->text))
            <p>{{ $task->text }}</p>
            @endif

            <div>
                <a class="btn btn-primary" href="{{ back()->getTargetUrl() }}">Back</a>
                @if(isset($task->file))
                <a href="{{ asset('files/' . $task->file)  }}" download="" class="btn btn-success">Download File</a>
                @endif
            </div>
        </div>
    </div>
@endsection
