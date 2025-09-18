<?php

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

Route::get('/tasks/{id}/edit', function($id) {
    return view('edit', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.edit');

Route::get('/tasks/{id}', function($id) {
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = new Task();

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
                    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}', function($id, Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::findOrFail($id);

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', $task->id)
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
