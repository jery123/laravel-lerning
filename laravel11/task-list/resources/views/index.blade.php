<h1>
    Hello i am a template
</h1>

<div>
    @if (count($tasks))
        @foreach ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ["id" => $task->id]) }}">{{ $task->title }}</a>
            </div>
        @endforeach
    @else
        <div>There is no task present in the database</div>
    @endif
</div>
