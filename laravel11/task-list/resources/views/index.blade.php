@extends('layouts.app')

@section('title', "Hello i am a template")

@section('content')
<div>
    @if (count($tasks))
        @foreach ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ["task" => $task->id]) }}">{{ $task->title }}</a>
            </div>
        @endforeach
    @else
        <div>There is no task present in the database</div>
    @endif
</div>

@if ($tasks->count())
    <nav>
        {{ $tasks->links() }}
    </nav>
@endif
@endsection
