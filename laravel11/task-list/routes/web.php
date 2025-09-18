<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;





Route::get('/', function(){return redirect()->route('tasks.index');});

Route::view('/tasks/create', 'create');

Route::get('/tasks', function () {
    return view('index', [
        'tasks'=> Task::latest()->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){
    // $data = $request->validated;

    // $task = new Task();

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
                    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
    // $data = $request->validated();

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
                    ->with('success', 'Task updated successfully!');
})->name('tasks.update');


// Route::get('/hello', function () {
//     return 'Hello';
// });

// Route::get('/xxx', function () {
//     return 'From the redirection';
// })->name('hello');

// Route::get('/redirect', function () {
//     return redirect('/xx');
// })->name('hello');



// To show a default page in case no page is showing
Route::fallback(function(){
    return "Still got something !";
});
