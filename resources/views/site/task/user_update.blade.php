@extends('layouts.site')

@section('content')
    @include('errors.errors')
    <div class="container">
        <h2 class="mb-5">Add user</h2>
        @if(isset($creator))
        <h3>Creator 0f project: {{ $creator }}</h3>
        @endif
        @if(!empty($team))
        <h4>Members of team:</h4>
            <ul>
                @foreach($team as $member)
                <li>{{ $member }}</li>
                @endforeach
            </ul>
        @endif

        @if(isset($id) && isset($usersNotTeam))
            <form method="post" action="{{ route('task.user.update', ['id' => $id]) }}">
                <select name="users[]" class="form-select mt-2 mb-2" multiple aria-label="multiple Default select example">
                    @foreach($usersNotTeam as $user)
                    <option>{{ $user }}</option>
                    @endforeach
                </select>
                @method('PATCH')
                @csrf
                <div class="d-flex justify-content-between">
                    @if(isset($id))
                        <a class="btn btn-primary" href="{{ route('task', ['id' => $id]) }}">Back</a>
                    @endif
                    <button type="submit" class="btn btn-primary ml-auto">Update</button>
                </div>
            </form>
        @endif
    </div>
@endsection
