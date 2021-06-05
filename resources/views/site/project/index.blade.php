@extends('layouts.site')

@section('content')
    <section class="container content">
        <h2 class="text-center mb-5">Choose a project or create a new one</h2>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 gy-2">
                <div class="card d-flex flex-column justify-content-center align-items-center h-100">
                    <a href="{{ route('project.create') }}" class="add_card">
                        <img src="{{ asset('img/add.png') }}" width="120px" alt="">
                    </a>
                </div>
            </div>
            @if(isset($projects) && is_array($projects))
                @foreach( $projects as $id => $title )
                <div class="col-sm-6 col-md-4 col-lg-3 gy-2">
                    <div class="card d-flex flex-column h-100">
                        <div class="d-flex justify-content-end">

                            <a href="{{ route('project.update', ['id' => $id]) }}" class="card__change">
                                <img class="d-block" src="{{ asset('img/edit.png') }}" width="17px" alt="">
                            </a>
                            <form method="post" action="{{ route('project.delete', ['id' => $id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn-close card__change" ></button>
                            </form>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            @if(isset($title))
                            <h5 class="card-title mb-5">{{ $title }}</h5>
                            @endif
                            @if(isset($id))
                            <a href="{{ route('task', ['id' => $id]) }}" class="btn btn-primary d-block">Tasks</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
