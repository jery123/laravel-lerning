@extends('layouts.app')

@section('title', $task->title)

@section('content')
<p>{{ $task->description}} </p>

@if ($task->long_description)
    <p>{{ $task->long_description}} </p>
@endif

<p>{{ $task->created_at}} </p>
<p>{{ $task->updated_at}} </p>

<form action="{{ route('tasks.delete', ['task' => $task->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete">
</form>
@endsection