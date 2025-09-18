@extends('layouts.app')

@section('title', isset($task) ? "Edit Task" : "Add Task")
    

@section('style')
    <style>
        .error-message{
           color:red;
           font-size: 0, 8rem; 
        }
    </style>
@endsection

@section('content')

<form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div class="mb-4">
        <label for="title">Title</label>
        <input name="title" id="title" value="{{ $task->title ?? old('title') }}">
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
        
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5">
            {{ $task->description ?? old('description') }}
        </textarea>
        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="long_description" rows="5">
            {{ $task->long_description ?? old('long_description') }}
        </textarea>
        @error('long_description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
        
    <div class="btn">
        <buttom type="submit">{{ isset($task) ? "Update Task" : "Add Task" }}</buttom>
    </div>

    </div>
</form>
@endsection